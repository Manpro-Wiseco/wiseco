<?php

namespace App\Http\Controllers\User\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\PesananPembelian;
use App\Models\Expense;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PesananPembelianController extends Controller
{
    public function index(Request $request)
    {
        return view('user.pembelian.pesanan-pembelian.index');
    }

    public function list(Request $request)
    {
        $data = PesananPembelian::with(['dataContact'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $urlEdit = route('pembelian.pesanan-pembelian.edit', $row->id);
                $actionBtn = '<a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" data-no_pesanan="' . $row->no_pesanan . '" type="button">
                        <i class="fas fa-trash"></i>
                    </button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function data(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = PesananPembelian::with(['dataContact', 'items'])->currentCompany()->where('status', 'Open')->get();
        } else {
            $data = PesananPembelian::with(['dataContact', 'items'])->currentCompany()->where('status', 'Open')->where('nameItem', 'like', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($data as $d) {

            $response[] = array(
                "id" => $d->id,
                "text" => $d->no_pesanan,
                "data" => $d,
                "item_count" => $d->items->count()
            );
        }
        return response()->json($response);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataContacts = DataContact::currentCompany()->status('Supplier')->get();
        return view('user.pembelian.pesanan-pembelian.create', compact('dataContacts'));
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
            'no_pesanan' => 'required',
            'tanggal' => 'required',
            'deskripsi' => 'required',
            'detail.*.subtotal' => 'required|numeric',
            'detail.*.data_produk_id' => 'required|numeric',
            'detail.*.harga_barang' => 'required|numeric',
            'detail.*.jumlah_barang' => 'required|numeric',
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = $request->detail;
        // dd($data);
        DB::transaction(function () use ($data, $detail) {
            $pembelian = PesananPembelian::create([
                'tanggal' => $data['tanggal'],
                'no_pesanan' => $data['no_pesanan'],
                'data_contact_id' => $data['data_contact_id'],
                'total' => $data['total'],
                'deskripsi' => $data['deskripsi'],
                'company_id' => $data['company_id'],
            ]);
            foreach ($detail as $key => $value) {
                DB::table('item_pembelian')->insert([
                    "pembelian_id" => $pembelian->id,
                    "item_id" => $value["data_produk_id"],
                    "jumlah_barang" => $value["jumlah_barang"],
                    "harga_barang" => $value["harga_barang"],
                    "subtotal" => $value["subtotal"],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
                // Get items table by id
                // $item = DB::table('items')->where('id', $value["data_produk_id"])->first();
                // Update stock
                //     DB::table('items')->where('id', $value["data_produk_id"])->update([
                //         'stockItem' => $item->stockItem + $value["jumlah_barang"],
                //         'updated_at' => Carbon::now()
                //     ]);
            }
        });

        return response()->json(['data' => ['pembelian' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil menambahkan data pembelian!']);
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
        $data = PesananPembelian::with(['dataContact'])->findOrFail($id);
        $dataContacts = DataContact::currentCompany()->status('Supplier')->get();
        return view('user.pembelian.pesanan-pembelian.edit', compact('data', 'dataContacts'));
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
            'no_pesanan' => 'required',
            'tanggal' => 'required',
            'deskripsi' => 'required',
            'detail.*.subtotal' => 'required|numeric',
            'detail.*.data_produk_id' => 'required|numeric',
            'detail.*.harga_barang' => 'required|numeric',
            'detail.*.jumlah_barang' => 'required|numeric',
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = $request->detail;
        $pembelian = PesananPembelian::find($id);

        // create new array with item_id value as a key with array of amount, jumlah_barang, harga_barang as pair of key and value
        $new_array = array_reduce($detail, function ($result, $item) {
            $result[$item['data_produk_id']] = [
                "jumlah_barang" => $item["jumlah_barang"],
                "harga_barang" => $item["harga_barang"],
                "subtotal" => $item["subtotal"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
            return $result;
        }, []);
        DB::transaction(function () use ($data, $pembelian, $new_array, $detail) {
            $pembelian->update([
                'tanggal' => $data['tanggal'],
                'no_pesanan' => $data['no_pesanan'],
                'data_contact_id' => $data['data_contact_id'],
                'total' => $data['total'],
                'deskripsi' => $data['deskripsi'],
            ]);
            $pembelian->items()->sync($new_array);
            // Get items table by id
            // foreach ($detail as $key => $value) {
            //     $item = DB::table('items')->where('id', $value["data_produk_id"])->first();
            //     // Update stock item
            //     DB::table('items')->where('id', $value["data_produk_id"])->update([
            //         'stockItem' => $item->stockItem + $value["jumlah_barang"],
            //         'updated_at' => Carbon::now()
            //     ]);
            // }
        });
        return response()->json(['data' => ['pembelian' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil mengubah data pemesanan pembelian barang!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DB::transaction(function () use ($id) {
        //     $pembelian = PesananPembelian::find($id);
        //     foreach ($pembelian->items as $key => $item) {
        //         $data_item = Item::find($item->id);
        //         $data_item->stockItem = $data_item->stockItem - $item->jumlah_barang;
        //         $data_item->save();
        //     }
        //     $pembelian->items()->detach();
        //     $pembelian->delete();
        // });
        return response()->json(['status' => TRUE, 'message' => 'Berhasil menghapus data pesanan pembelian!']);
    }
}
