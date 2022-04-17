<?php

namespace App\Http\Controllers\User\PengelolaanKas;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pengelolaan-kas.income.index');
    }

    public function list(Request $request)
    {
        $data = Income::with(['dataAccounts', 'dataContact'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total_text', function ($row) {
                return "Rp " . number_format($row->total, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('pengelolaan-kas.income.edit', $row->id);
                $urlShow = route('pengelolaan-kas.income.show', $row->id);
                $actionBtn = '
                <a href="' . $urlShow . '" class="btn bg-gradient-success btn-small">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                    <i class="fas fa-edit"></i>
                </a>
                
    <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" data-invoice="' . $row->invoice . '" type="button">
        <i class="fas fa-trash"></i>
    </button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataContacts = DataContact::currentCompany()->get();
        return view('user.pengelolaan-kas.income.create', compact('dataContacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_contact_id' => 'required|numeric',
            'invoice' => 'required',
            'transaction_date' => 'required',
            'to_account_id' => 'required',
            'description' => 'required',
            'detail.*.amount' => 'required|numeric',
            'detail.*.data_account_id' => 'required|numeric'
        ]);
        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = $request->detail;
        DB::transaction(function () use ($data, $detail) {
            $income = Income::create($data);
            foreach ($detail as $key => $value) {
                DB::table('detail_incomes')->insert([
                    "income_id" => $income->id,
                    "data_account_id" => $value["data_account_id"],
                    "amount" => $value["amount"],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }
        });
        return response()->json(['data' => ['income' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil menambahkan data pemasukan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $income = Income::with(['dataContact', 'toAccount', 'dataAccounts'])->findOrFail($id);
        $company = session()->get('company');
        return view('user.pengelolaan-kas.income.show', compact('income', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $income = Income::with(['toAccount', 'dataContact', 'dataAccounts'])->findOrFail($id);
        $dataContacts = DataContact::currentCompany()->get();
        return view('user.pengelolaan-kas.income.edit', compact('income', 'dataContacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'data_contact_id' => 'required|numeric',
            'invoice' => 'required',
            'transaction_date' => 'required',
            'to_account_id' => 'required',
            'description' => 'required',
            'detail.*.amount' => 'required|numeric',
            'detail.*.data_account_id' => 'required|numeric'
        ]);
        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = $request->detail;
        // create new array with data_account_id value as a key with amount as pair of key and value
        $new_detail = array_reduce($detail, function ($result, $item) {
            $result[$item['data_account_id']] = ["amount" => $item['amount']];
            return $result;
        }, []);
        $income = Income::findOrFail($id);
        $income->update($data);
        $income->dataAccounts()->sync($new_detail);
        return response()->json(['data' => ['income' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil mengubah data pemasukan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        $income->dataAccounts()->detach();
        $income->delete();
        return response()->json(['status' => TRUE, 'message' => 'Berhasil menghapus data pemasukan!']);
    }
}
