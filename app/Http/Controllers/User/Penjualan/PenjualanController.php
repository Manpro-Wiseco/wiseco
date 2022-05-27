<?php

namespace App\Http\Controllers\User\Penjualan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenjualanRequest;
use App\Models\DataBank;
use App\Models\DataContact;
use App\Models\Penjualan;
use App\Models\Expense;
use App\Models\ItemPenjualan;
use App\Models\PesananPenjualan;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        return view('user.penjualan.penjualan.index');
    }

    public function list(Request $request)
    {
        $data = Penjualan::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nilai', function ($row) {
                return "Rp " . number_format($row->nilai, 2, ',', '.');
            })
            ->addColumn('sisa_pembayaran', function ($row) {
                return "Rp " . number_format($row->sisa_pembayaran, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('penjualan.penjualan.edit', $row->id);
                $urlDelete = route('penjualan.penjualan.destroy', $row->id);
                $actionBtn = '<a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a  href="' . $urlDelete . '" class="btn bg-gradient-danger btn-small" type="button" onclick="if(!confirm(`Apakah anda yakin?`)) return false";>
                        <i class="fas fa-trash"></i>
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
        $dataContacts = DataContact::currentCompany()->get();
        $banks = DataBank::all();
        return view('user.penjualan.penjualan.create', compact('dataContacts', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenjualanRequest $request)
    {
        // print_r($request->all());
        
        $pelanggan = DataContact::select('name')->where('id', $request->pelanggan_id)->first();
        $data = [
            'tanggal' => $request->tanggal,
            'no_penjualan' => $request->no_penjualan,
            'nama_pelanggan' => $pelanggan->name,
            'deskripsi' => $request->deskripsi,
            'nilai' => $request->nilai,
            'company_id' => session()->get('company')->id,
            'data_bank_id' => $request->data_bank_id,
            'total_pembayaran' => $request->total_pembayaran,
            'sisa_pembayaran' => $request->sisa_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'pesanan_id' => $request->penjualan_id,
        ];
        // print_r($data);

        DB::transaction(function () use ($data, $request) {
            Penjualan::create($data);
            PesananPenjualan::findOrFail($request->penjualan_id)->update(['status' => 'DITERIMA']);
        });
        // return response()->json(['data' => ['expenses' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil menambahkan data pengeluaran!']);
        return redirect()->back()->with('success', 'Berhasil Menambahkan Data!');
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
        $dataContacts = DataContact::currentCompany()->get();
        $banks = DataBank::all();
        $data = Penjualan::with('pesanan')->findOrFail($id);
        // print_r($data->pesanan->pelanggan_id);
        return view('user.penjualan.penjualan.edit', compact('dataContacts', 'banks', 'data'));
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
        // print_r($request->all());

        $validator = Validator::make($request->all(), [
            'data_bank_id' => 'required',
            'status_pembayaran' => 'required',
            'total_pembayaran' => 'required|integer',
            'sisa_pembayaran' => 'required|integer',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = [
            'data_bank_id' => $request->data_bank_id,
            'status_pembayaran' => $request->status_pembayaran,
            'total_pembayaran' => $request->total_pembayaran,
            'sisa_pembayaran' => $request->sisa_pembayaran,
            'status' => $request->status,
        ];

        DB::transaction(function () use ($data, $id) {
            Penjualan::findOrFail($id)->update($data);
        });
        
        return redirect()->back()->with('success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Penjualan::findOrFail($id);
        PesananPenjualan::findOrFail($order->pesanan_id)->update(['status' => 3]);
        $order->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data!');
    }

    public function listPesanan($id)
    {
        $data = PesananPenjualan::select(['id', 'no_pesanan'])->where([
            ['pelanggan_id','=', $id],
            ['status','=', 3]
            ])->get();
        return response()->json($data);
    }

    public function detailPesanan($id)
    {
        $data = PesananPenjualan::with('item')->where('id', $id)->first();
        $items = ItemPenjualan::with('item')->where('pesanan_penjualan_id', $id)->get();
        $respone = array(
            'data' => $data,
            'item' => $items,
        );
        return response()->json($respone);
    }

    public function getHarga($id)
    {
        # code...
    }
}