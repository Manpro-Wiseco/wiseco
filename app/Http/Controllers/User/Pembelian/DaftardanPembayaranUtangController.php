<?php

namespace App\Http\Controllers\User\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\DaftarPembayaranUtang;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DaftardanPembayaranUtangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.pembelian.Daftar-Pembayaran-Utang.index');
    }

    public function list(Request $request)
    {
        $data = FakturPembelian::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $urlEdit = route('pembelian.Daftar-Pembayaran-Utang..edit', $row->id);
                $urlDelete = route('pembelian.Daftar-Pembayaran-Utang..destroy', $row->id);
                $actionBtn = '<a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn bg-gradient-danger btn-small" type="button">
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
        return view('user.pembelian.Daftar-Pembayaran-Utang..create', compact('dataContacts'));
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
            'description' => 'required',
            'detail.*.amount' => 'required|numeric',
            'detail.*.bank_account_id' => 'required|numeric'
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
                    "bank_account_id" => $value["bank_account_id"],
                    "amount" => $value["amount"],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }
        });
        return response()->json(['data' => ['expenses' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil menambahkan data pengeluaran!']);
        // return redirect()->route('pengelolaan-kas.bank-account.index')->with('success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}