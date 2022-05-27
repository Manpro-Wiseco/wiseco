<?php

namespace App\Http\Controllers\User\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\ReturPenjualan;
use App\Models\Expense;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReturPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('user.penjualan.retur-penjualan.index');
    }

    public function list(Request $request)
    {
        $data = ReturPenjualan::with('penjualan')->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_pelanggan', function ($row) {
                return $row->pelanggan->name;
            })
            ->addColumn('perusahaan', function ($row) {
                return $row->company->name;
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('penjualan.retur-penjualan.edit', $row->id);
                $urlDelete = route('penjualan.retur-penjualan.destroy', $row->id);
                $actionBtn = '<button id="editRetur" class="btn bg-gradient-info btn-small" data-id="'.$row->id.'">
                <i class="fas fa-edit"></i>
            </button>
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
        // $dataContacts = DataContact::currentCompany()->get();
        $dataRetur = Penjualan::currentCompany()->where('status', 'RETUR')->get();
        // print_r($dataRetur);
        return view('user.penjualan.retur-penjualan.create', compact('dataRetur'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $data = Arr::add($data, 'status', 'DIPROSES');
        // $data = Arr::except($request->all(), 'detail');  
        // $detail = $request->detail;
        DB::transaction(function () use ($data, $request) {
            $penjualan = Penjualan::with(['pesanan'])->findOrFail($request->penjualan_id);
            $data = Arr::add($data, 'pelanggan_id', $penjualan->pesanan->pelanggan_id);
            $penjualan->update(['status' => 6]); //status => DIPROSES
            $expense = ReturPenjualan::create($data);
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
        $request->validate([
            'tanggal_retur'         => 'required',
            'deskripsi'             => 'required|string|max:400',
            'status'                => 'required',
          ]);
  
        $data = Arr::except($request->all(), ['_token','penjualan_id']);
        $id_penjualan = $request->penjualan_id;
        try {
            DB::transaction(function () use ($data, $id, $request, $id_penjualan) {
                ReturPenjualan::findOrFail($id)->update($data);
                $penjualan = Penjualan::findOrFail($id_penjualan);
                if ($request->status == 'PENDING') {
                    $penjualan->update(['status' => 'DIPROSES']);
                }else if($request->status == 'DIPROSES'){
                    $penjualan->update(['status' => 'DIPROSES']);
                }else if($request->status == 'DIKIRIM'){
                    $penjualan->update(['status' => 'DIPROSES']);
                }else if($request->status == 'DITOLAK'){
                    $penjualan->update(['status' => 'DITOLAK']);
                }else if($request->status == 'DITERIMA'){
                    $penjualan->update(['status' => 'SELESAI']);
                }
            });          
            // redirect the page
            return response()->json(['success'=>'Ajax request submitted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error'=> $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = ReturPenjualan::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data!');
    }

    public function getData($id)
    {
        $retur = ReturPenjualan::with(['penjualan'])->findOrFail($id);
        return response()->json($retur);
    }
}