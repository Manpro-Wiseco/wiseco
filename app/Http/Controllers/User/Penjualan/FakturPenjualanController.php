<?php

namespace App\Http\Controllers\User\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\FakturPenjualan;
use App\Models\Expense;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\Auth;

class FakturPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.penjualan.faktur-penjualan.index');
    }

    public function list(Request $request)
    {
        $data = Penjualan::where('status', '!=', 'DRAFT')->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $urlStream = route('penjualan.faktur-penjualan.get-faktur-penjualan', ['type' => 'stream', 'id' => $row->id]);
                $urlDownload = route('penjualan.faktur-penjualan.get-faktur-penjualan', ['type' => 'download', 'id' => $row->id]);
                $actionBtn = '<a href="' . $urlDownload . '" class="btn bg-gradient-info btn-small">
                        <i class="fas fa-print"></i>
                    </a>
                    <a href="' . $urlStream . '" class="btn bg-gradient-info btn-small" type="button" id="lihat-detail">
                        <i class="fas fa-eye"></i>
                    </a>';
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
        // $dataContacts = DataContact::currentCompany()->get();
        // return view('user.penjualan.faktur-penjualan.create', compact('dataContacts'));
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

    public function getFaktur($type, $id)
    {

        $data_details = Penjualan::with('pesanan.item','pesanan.pelanggan')->findOrFail($id);
        $data = [
            'logo' => asset('assets/img/logo-ct.png'),
            'name_apps' => 'WISECO',
        ];

        // $faktur_check = FakturPenjualan::where('penjualan_id', $id)->exists();
        // if ($faktur_check) {
        //     DB::transaction(function () use ($data_saved) {
        //         FakturPenjualan::where();
        //     });  
        //     dd('Ada');
        // }else{
        //     $data_saved = [
        //         'penjualan_id' => $id,
        //         'company_id' => session()->get('company')->id,
        //         'user_pencetak' => Auth::user()->name,
        //         'status' => 'DICETAK',
        //         'jumlah_dicetak' => 1,
        //         'no_faktur' => Str::random(10),
        //     ];
        //     DB::transaction(function () use ($data_saved) {
        //         FakturPenjualan::create($data_saved);
        //     });  
        //     // dd('tidak ada');
        // }

        $pdf = PDF::loadView('user.penjualan.faktur-penjualan.fakturPDF', ['data_details'=>$data_details, 'data' => $data, 'pelanggan' => $data_details->pesanan->pelanggan]);

        if ($type == 'stream') {
            return $pdf->stream(Carbon::now()->format('Y-m-d').'-faktur-penjualan.pdf-'.$data_details->no_penjualan);
        }

        if ($type == 'download') {
            return $pdf->download(Carbon::now()->format('Y-m-d').'-faktur-penjualan-'.$data_details->no_penjualan.'.pdf');
        }
    }
}