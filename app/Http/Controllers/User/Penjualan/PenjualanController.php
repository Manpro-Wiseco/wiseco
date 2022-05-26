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
            'status' => "DITERIMA",
            'company_id' => session()->get('company')->id,
            'data_bank_id' => $request->data_bank_id,
            'total_pembayaran' => $request->total_pembayaran,
            'sisa_pembayaran' => $request->sisa_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'Penjualan_id' => $request->penjualan_id,
        ];
        // print_r($data);

        DB::transaction(function () use ($data) {
            Penjualan::create($data);
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
        $order = Penjualan::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data!');
    }

    public function listPesanan($id)
    {
        $data = PesananPenjualan::select(['id', 'no_pesanan'])->where('pelanggan_id', $id)->get();
        return response()->json($data);
    }

    public function detailPesanan($id)
    {
        $data = PesananPenjualan::with('item')->where('id', $id)->first();
        $items = ItemPenjualan::with('item')->where('penjualan_id', $id)->get();
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