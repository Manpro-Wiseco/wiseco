<?php

namespace App\Http\Controllers\User\Penjualan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PesananPenjualanRequest;
use App\Models\DataContact;
use App\Models\PesananPenjualan;
use App\Models\Expense;
use App\Models\Item;
use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PesananPenjualanController extends Controller
{
    public function index(Request $request)
    {
        return view('user.penjualan.pesanan-penjualan.index');
    }

    public function list(Request $request)
    {
        $data = PesananPenjualan::with(['pelanggan'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_pelanggan', function ($row) {
                return $row->pelanggan->name;
            })
            ->addColumn('nilai', function ($row) {
                return "Rp " . number_format($row->nilai, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlDelete = route('penjualan.pesanan-penjualan.destroy', $row->id);
                if ($row->status != "DITERIMA" ) {
                    $urlEdit = route('penjualan.pesanan-penjualan.edit', $row->id);
                    $actionBtn = '<a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="' . $urlDelete . '" class="btn bg-gradient-danger btn-small" type="button" onclick="if(!confirm(`Apakah anda yakin?`)) return false">
                            <i class="fas fa-trash"></i>
                        </a>';
                }else{
                    $actionBtn = '<a href="#" class="btn bg-gradient-info btn-small" onclick="alert(`Status sudah diterima!`)">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="' . $urlDelete . '" class="btn bg-gradient-danger btn-small" type="button" onclick="if(!confirm(`Apakah anda yakin?`)) return false">
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
        // print_r (Auth::user());
        $dataContacts = DataContact::currentCompany()->get();
        return view('user.penjualan.pesanan-penjualan.create', compact('dataContacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PesananPenjualanRequest $request)
    {
        // print_r($request->all());
        
        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'items');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $data = Arr::add($data, 'status', 'DRAFT');
        $detailOrder = $request->items;
        // print_r($detailOrder[0]);
        DB::transaction(function () use ($data, $detailOrder) {
            $pesanan = PesananPenjualan::create($data);

            foreach ($detailOrder as $order => $item) {
                DB::table('item_penjualan')->insert([
                    "item_id" => $item['id'],
                    "pesanan_penjualan_id" => $pesanan->id,
                    "jumlah_barang" => $item['qty'],
                    "harga_barang" => $item['harga_unit'],
                    "subtotal" => $item['total'],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PesananPenjualan::with(['pelanggan'])->where('id', $id)->first();
        $dataContacts = DataContact::currentCompany()->get();
        // print_r($data);
        return view('user.penjualan.pesanan-penjualan.edit', compact('data','dataContacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PesananPenjualanRequest $request, $id)
    {
        // print_r($request->all());

        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'items');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $data = Arr::add($data, 'status', 'DRAFT');
        $detailOrder = $request->items;
        // print_r($detailOrder[0]);
        DB::transaction(function () use ($data, $detailOrder, $id) {
            ItemPenjualan::where('pesanan_penjualan_id', $id)->delete();
            $pesanan = PesananPenjualan::findOrFail($id);
            $pesanan->update($data);

            foreach ($detailOrder as $order => $item) {
                DB::table('item_penjualan')->insert([
                    "item_id" => $item['id'],
                    "pesanan_penjualan_id" => $pesanan->id,
                    "jumlah_barang" => $item['qty'],
                    "harga_barang" => $item['harga_unit'],
                    "subtotal" => $item['total'],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }
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
        $data = PesananPenjualan::where('id', $id)->first();
        if ($data->penjualan) {
            $penjualan = Penjualan::where('id', $data->penjualan->id)->first();
            if ($penjualan->pengiriman || $penjualan->retur || $penjualan->piutang) {
                return redirect()->back()->with('fail', 'Gagal Menghapus Data, data digunakan pada tabel lain!');
            }
            // dd($penjualan->pengiriman ? 'True' : 'False');
        }
        // dd('dont have penjualan');
        ItemPenjualan::where('pesanan_penjualan_id', $id)->delete();
        $order = PesananPenjualan::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data!');
    }

    public function getItem(Request $request)
    {
        $search = $request->search;

      if($search == ''){
          $data = Item::currentCompany()->get();
        }else{
          $data = Item::currentCompany()->where('nameItem', 'like', '%' .$search . '%')->orderby('nameItem','asc')->get();
      }
        $results = [];
        foreach ($data as $d) {
            $results[] = array(
                'id' => $d->id,
                'text' => $d->nameItem,
            );
        }
        return response()->json($results);
        // return "data";
    }

    public function getItemDetail($id)
    {
        $data = ItemPenjualan::query()->with(['item'])->where('pesanan_penjualan_id', $id)->get();
        return response()->json($data);
    }

    public function getHarga($id)
    {
        $data = Item::currentCompany()->select('priceItem')->where('id', $id)->first();
        return response()->json($data);
    }
}