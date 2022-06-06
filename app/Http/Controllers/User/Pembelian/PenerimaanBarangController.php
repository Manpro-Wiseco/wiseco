<?php

namespace App\Http\Controllers\User\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\PenerimaanBarang;
use App\Models\Expense;
use App\Models\Item;
use App\Models\PesananPembelian;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use LengthException;
use Yajra\DataTables\DataTables;

class PenerimaanBarangController extends Controller
{
    public function index(Request $request)
    {
        return view('user.pembelian.Penerimaan-barang.index');
    }

    public function list(Request $request)
    {
        $data = PenerimaanBarang::with(['items', 'dataContact'])->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('item_count', function ($row) {
                return $row->items->count();
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('pembelian.penerimaan-barang.edit', $row->id);
                $actionBtn = '<a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn bg-gradient-danger btn-small btn-delete" type="button">
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
        $dataContacts = DataContact::currentCompany()->status('Supplier')->get();
        return view('user.pembelian.Penerimaan-barang.create', compact('dataContacts'));
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
            'pesanan_id' => 'required',
            'no_penerimaan' => 'required',
            'tanggal' => 'required',
            'deskripsi' => 'required',
            'subtotal.*' => 'required|numeric',
            'data_produk_id.*' => 'required|numeric',
            'harga_barang.*' => 'required|numeric',
            'jumlah_barang.*' => 'required|numeric',
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = [
            'data_produk_id' => $request->data_produk_id,
            'harga_barang' => $request->harga_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'subtotal' => $request->subtotal,
        ];
        DB::transaction(function () use ($data, $detail) {
            $penerimaan = PenerimaanBarang::create([
                'tanggal' => $data['tanggal'],
                'pesanan_id' => $data['pesanan_id'],
                'data_contact_id' => $data['data_contact_id'],
                'no_penerimaan' => $data['no_penerimaan'],
                'total' => array_sum($detail['subtotal']),
                'deskripsi' => $data['deskripsi'],
                'company_id' => $data['company_id'],
                'status' => 'Open',
            ]);
            $pesanan = PesananPembelian::find($data['pesanan_id']);
            $pesanan->update([
                'status' => 'Diterima',
            ]);
            for ($i = 0; $i < count($detail['data_produk_id']); $i++) {
                DB::table('item_penerimaan')->insert([
                    "penerimaan_id" => $penerimaan->id,
                    "item_id" => $detail["data_produk_id"][$i],
                    "jumlah_barang" => $detail["jumlah_barang"][$i],
                    "harga_barang" => $detail["harga_barang"][$i],
                    "subtotal" => $detail["subtotal"][$i],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
                $item = Item::find($detail["data_produk_id"][$i]);
                $item->update([
                    'stockItem' => $item->stockItem + $detail["jumlah_barang"][$i],
                    'updated_at' => Carbon::now()
                ]);
            }

            // Get items table by id
            // $item = DB::table('items')->where('id', $value["data_produk_id"])->first();
            // Update stock
            //     DB::table('items')->where('id', $value["data_produk_id"])->update([
            //         'stockItem' => $item->stockItem + $value["jumlah_barang"],
            //         'updated_at' => Carbon::now()
            //     ]);

        });

        return redirect()->route('pembelian.penerimaan-barang.index');
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
        $data = PenerimaanBarang::with(['dataContact'])->findOrFail($id);
        $dataContacts = DataContact::currentCompany()->status('Supplier')->get();
        return view('user.pembelian.penerimaan-barang.edit', compact('data', 'dataContacts'));
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
        DB::transaction(function () use ($id) {
            $penerimaan = Penerimaanbarang::find($id);
            foreach ($penerimaan->items as $key => $item) {
                $data_item = Item::find($item->id);
                $data_item->stockItem = $data_item->stockItem - $item->jumlah_barang;
                $data_item->save();
            }
            $penerimaan->items()->detach();
            $penerimaan->delete();
        });
       
       return response()->json(['status' => TRUE, 'message' => 'Berhasil menghapus data penerimaan barang!']);
    }
}
