<?php

namespace App\Http\Controllers\User\Penjualan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PiutangRequest;
use App\Models\DaftarPembayaranUtang;
use App\Models\DataBank;
use App\Models\HistoryBayarPiutang;
use App\Models\PembayaranPiutangPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PiutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Penjualan::where('status_pembayaran', 'KREDIT')->get();
        $banks = DataBank::all();
        return view('user.penjualan.daftar-piutang.index', compact('data','banks'));
    }

    public function list(Request $request)
    {
        $data = PembayaranPiutangPenjualan::orderBy('status','desc')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_pelanggan', function ($row) {
                return $row->pelanggan->name;
            })
            ->addColumn('beban_pembayaran', function ($row) {
                return "Rp " . number_format($row->beban_pembayaran, 2, ',', '.');
            })
            ->addColumn('sisa_piutang', function ($row) {
                return "Rp " . number_format($row->sisa_piutang, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlDelete = route('penjualan.daftar-piutang.destroy', $row->id);
                if ($row->status == "LUNAS") {
                    $actionBtn = '<button id="pembayaran-piutang" data-id="'.$row->id.'" class="btn bg-gradient-warning btn-small">
                            <i class="fas fa-money-bill"></i>
                        </button>
                        <a href="'.$urlDelete.'" class="btn bg-gradient-danger btn-small" type="button" onclick="if(!confirm(`Apakah anda yakin?`)) return false">
                            <i class="fas fa-trash"></i>
                        </a>';
                }else{
                    $actionBtn = '<button id="pembayaran-piutang" data-id="'.$row->id.'" class="btn bg-gradient-warning btn-small">
                            <i class="fas fa-money-bill"></i>
                        </button>
                        <button id="edit-piutang" data-id="'.$row->id.'" class="btn bg-gradient-info btn-small">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a href="'.$urlDelete.'" class="btn bg-gradient-danger btn-small" type="button" onclick="if(!confirm(`Apakah anda yakin?`)) return false">
                            <i class="fas fa-trash"></i>
                        </a>';
                }
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
        $data = Penjualan::where('status_pembayaran', 'KREDIT')->get();
        return view('user.penjualan.daftar-piutang.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PiutangRequest $request)
    {
        // dd($request->all());
        
        $data = Arr::except($request->all(), '_token');
        $newDate = date('Y-m-d', strtotime($data['tanggal_awal_kredit']. ' + '. $data['tenor'] . ' months'));
        $dataPenjualan = Penjualan::with('pesanan.pelanggan')->findOrFail($data['penjualan_id'])->first();
        $data = Arr::add($data, 'tanggal_akhir_kredit', $newDate);
        $data = Arr::add($data, 'pelanggan_id', $dataPenjualan->pesanan->pelanggan->id);

        // dd($data);
        DB::transaction(function () use ($data) {
            Penjualan::findOrFail($data['penjualan_id'])->update(['status_pembayaran' => 'CICILAN']);
            PembayaranPiutangPenjualan::create($data);
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
        try {
        $request->validate([
            'tanggal_awal_kredit'   => 'required',
            'sisa_piutang'          => 'required',
            'tenor'                 => 'required',
            'status'                => 'required',
            'beban_pembayaran'      => 'required',
          ]);
  
        $data = Arr::except($request->all(), ['_token','no_penjualan']);
        $no_penjualan = $request->no_penjualan;
            DB::transaction(function () use ($data, $id, $request, $no_penjualan) {
                PembayaranPiutangPenjualan::findOrFail($id)->update($data);

                $penjualan = Penjualan::where('no_penjualan',$no_penjualan);
                if ($request->status == 'LUNAS') {
                    $penjualan->update(['status_pembayaran' => 'LUNAS']);
                }else if($request->status == 'BELUM LUNAS'){
                    $penjualan->update(['status_pembayaran' => 'BELUM LUNAS']);
                }else {
                    $penjualan->update(['status_pembayaran' => 'CICILAN']);
                }
            });          
            // redirect the page
            return response()->json(['success'=>'Ajax request submitted successfully'], '200');
        } catch (\Exception $e) {
            return response()->json(['error'=> $e->getMessage()], '404');
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
        $piutang = PembayaranPiutangPenjualan::findOrFail($id);
        Penjualan::findOrFail($piutang->penjualan->id)->update(['status_pembayaran' => 'KREDIT']);
        $piutang->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus Data!');
    }

    public function getData($id)
    {
        $data = Penjualan::where('id', $id)->first();
        return response()->json($data);
    }

    public function getDataDetail($id)
    {
        $data = PembayaranPiutangPenjualan::with(['penjualan','pelanggan'])->where('id', $id)->first();
        return response()->json($data);
    }

    public function storeDetailBayar(Request $request, $id)
    {
        try {
            $request->validate([
                'sisa_piutang'          => 'required',
                'tanggal_pembayaran'    => 'required',
                'total_pembayaran'      => 'required',
                'data_bank_id'          => 'required',
              ]);
              
            $sisa_piutang = (int)$request->sisa_piutang;
            $total_pembayaran = (int)$request->total_pembayaran;
            $sisa_pembayaran = $sisa_piutang - $total_pembayaran;
            
            if ($sisa_pembayaran <= 0) {
                $status = 'LUNAS';
            }else{
                $status = 'BELUM LUNAS';
            }
            $data = Arr::except($request->all(), ['_token', 'sisa_piutang']);
            $data = Arr::add($data, 'piutang_id', $id);
            $data = Arr::add($data, 'sisa_pembayaran', $sisa_pembayaran);
            $data = Arr::add($data, 'status', $status);

            DB::transaction(function () use ($data, $id, $sisa_pembayaran, $status) {
                $data_penjualan = PembayaranPiutangPenjualan::findOrFail($id);
                $data_penjualan->update(['sisa_piutang' => $sisa_pembayaran]);
                if ($status == 'LUNAS') {
                    $data_penjualan->update(['status' => 'LUNAS']);
                    Penjualan::findOrFail($data_penjualan->penjualan_id)->update(['status_pembayaran' => 'LUNAS','sisa_pembayaran' => $sisa_pembayaran]);
                }else{
                    $data_penjualan->update(['status' => 'BELUM LUNAS']);
                }

                HistoryBayarPiutang::create($data);
            });          
            // redirect the page
            return response()->json(['success'=>'Ajax request submitted successfully', 'data' => $data], '200');
        } catch (\Exception $e) {
            return response()->json(['error'=> $e->getMessage()], '404');
        }
    }

    public function listHistory($id)
    {
        $data = HistoryBayarPiutang::where('piutang_id', $id)->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total_pembayaran', function ($row) {
                return "Rp " . number_format($row->total_pembayaran, 2, ',', '.');
            })
            ->addColumn('sisa_pembayaran', function ($row) {
                return "Rp " . number_format($row->sisa_pembayaran, 2, ',', '.');
            })
            ->addColumn('jenis_pembayaran', function ($row) {
                return $row->bank->name;
            })
            ->make(true);
    }
}
