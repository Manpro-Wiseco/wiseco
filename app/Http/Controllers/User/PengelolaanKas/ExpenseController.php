<?php

namespace App\Http\Controllers\User\PengelolaanKas;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pengelolaan-kas.expense.index');
    }

    public function list(Request $request)
    {
        $data = Expense::with(['dataContact'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('penerima', function ($row) {
                return $row->dataContact->name;
            })
            ->addColumn('total_text', function ($row) {
                return "Rp " . number_format($row->total, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('pengelolaan-kas.expense.edit', $row->id);
                $urlShow = route('pengelolaan-kas.expense.show', $row->id);
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
        return view('user.pengelolaan-kas.expense.create', compact('dataContacts'));
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
            'from_account_id' => 'required',
            'description' => 'required',
            'detail.*.amount' => 'required|numeric',
            'detail.*.data_account_id' => 'required|numeric'
        ]);
        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = $request->detail;
        DB::transaction(function () use ($data, $detail) {
            $expense = Expense::create($data);
            foreach ($detail as $key => $value) {
                DB::table('detail_expenses')->insert([
                    "expense_id" => $expense->id,
                    "data_account_id" => $value["data_account_id"],
                    "amount" => $value["amount"],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }
        });
        return response()->json(['data' => ['expenses' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil menambahkan data pengeluaran!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = Expense::with(['dataContact', 'fromAccount', 'dataAccounts'])->findOrFail($id);
        $company = session()->get('company');
        return view('user.pengelolaan-kas.expense.show', compact('expense', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = Expense::with(['fromAccount', 'dataContact', 'dataAccounts'])->findOrFail($id);
        $dataContacts = DataContact::currentCompany()->get();
        return view('user.pengelolaan-kas.expense.edit', compact('expense', 'dataContacts'));
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
            'from_account_id' => 'required',
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
        $expense = Expense::findOrFail($id);
        $expense->update($data);
        $expense->dataAccounts()->sync($new_detail);
        return response()->json(['data' => ['expenses' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil mengubah data pengeluaran!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->dataAccounts()->detach();
        $expense->delete();
        return response()->json(['status' => TRUE, 'message' => 'Berhasil menghapus data pengeluaran!']);
    }
}
