<?php

namespace App\Http\Controllers\User\Penjualan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengirimanRequest;
use App\Models\DataContact;
use App\Models\PengirimanBarang;
use App\Models\Expense;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PengirimanBarangController extends Controller
{
    public function index(Request $request)
    {
        return view('user.penjualan.pengiriman-barang.index');
    }

    public function list(Request $request)
    {
        $data = PengirimanBarang::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('invoice', function ($row) {
                if ($row->penjualan->no_penjualan) {
                    return $row->penjualan->no_penjualan;
                }else{
                    return false;
                }
            })
            ->addColumn('nama_pelanggan', function ($row) {
                return $row->penjualan->nama_pelanggan;
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('penjualan.pengiriman-barang.edit', $row->id);
                $urlDelete = route('penjualan.pengiriman-barang.destroy', $row->id);
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
        $dataPenjualan = Penjualan::currentCompany()->where([
            ['status_pembayaran','=', 1], //lunas
            ['status','=',3], //draft
            ])
            ->get();
        return view('user.penjualan.pengiriman-barang.create', compact('dataPenjualan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengirimanRequest $request)
    {
        // print_r($request->all());
      
        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $data = Arr::add($data, 'status', 'DIKIRIM');
        // $data = Arr::except($request->all(), 'detail');  
        // $detail = $request->detail;
        DB::transaction(function () use ($data, $request) {
            Penjualan::findOrFail($request->penjualan_id)->update(['status' => 4]);
            $expense = PengirimanBarang::create($data);
        });

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
        $order = PengirimanBarang::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data!');
    }
}