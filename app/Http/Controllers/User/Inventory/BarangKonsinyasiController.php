<?php

namespace App\Http\Controllers\User\Inventory;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use App\Models\Konsinyasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BarangKonsinyasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.inventory.barang-konsinyasi.index');
    }

    public function list(Request $request)
    {
        $data = Konsinyasi::with(['dataContact'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('nama_customer', function ($row) {
                return $row->dataContact->name;
            })
            ->addColumn('total_rupiah', function ($row) {
                return "Rp " . number_format($row->total_harga, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('inventory.barang-konsinyasi.edit', $row->id);
                $urlShow = route('inventory.barang-konsinyasi.show', $row->id);
                $actionBtn = '
                <a href="' . $urlShow . '" class="btn bg-gradient-success btn-small">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" data-invoice="' . $row->invoiceKonsinyasi . '" type="button">
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
        $dataContacts = DataContact::currentCompany()->where('status', 'Customer')->get();
        return view('user.inventory.barang-konsinyasi.create', compact('dataContacts'));
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
            'warehouse_id' => 'required',
            'description' => 'required',
            'detail.*.amount' => 'required|numeric',
            'detail.*.data_produk_id' => 'required|numeric',
            'detail.*.priceItem' => 'required|numeric'
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = $request->detail;
        // dd($data);
        DB::transaction(function () use ($data, $detail) {
            $konsinyasi = Konsinyasi::create([
                'dateKonsinyasi' => $data['transaction_date'],
                'invoiceKonsinyasi' => $data['invoice'],
                'data_contact_id' => $data['data_contact_id'],
                'total_harga' => $data['total'],
                'keterangan' => $data['description'],
                'company_id' => $data['company_id'],
                'warehouse_id' => $data['warehouse_id']
            ]);
            foreach ($detail as $key => $value) {
                DB::table('item_konsinyasi')->insert([
                    "konsinyasi_id" => $konsinyasi->id,
                    "item_id" => $value["data_produk_id"],
                    "jumlah_barang" => $value["jumlah_barang"],
                    "harga_barang" => $value["priceItem"],
                    "subtotal" => $value["amount"],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);
            }
        });

        return response()->json(['data' => ['konsinyasi' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil menambahkan data konsinyasi!']);
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
        $konsinyasi = Konsinyasi::find($id);
        $dataContacts = DataContact::currentCompany()->where('status', 'Customer')->get();
        return view('user.inventory.barang-konsinyasi.edit', compact('konsinyasi', 'dataContacts'));
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
            'invoice' => 'required',
            'transaction_date' => 'required',
            'warehouse_id' => 'required',
            'description' => 'required',
            'detail.*.amount' => 'required|numeric',
            'detail.*.data_produk_id' => 'required|numeric',
            'detail.*.priceItem' => 'required|numeric'
        ]);

        $konsinyasi = Konsinyasi::find($id);
        $data = Arr::except($request->all(), '_token');
        $data = Arr::except($request->all(), 'detail');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $detail = $request->detail;

        // create new array with item_id value as a key with array of amount, jumlah_barang, harga_barang as pair of key and value
        $new_array = array_reduce($detail, function ($result, $item) {
            $result[$item['data_produk_id']] = [
                "jumlah_barang" => $item["jumlah_barang"],
                "harga_barang" => $item["priceItem"],
                "subtotal" => $item["amount"],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ];
            return $result;
        }, []);

        $konsinyasi->update([
            'dateKonsinyasi' => $data['transaction_date'],
            'invoiceKonsinyasi' => $data['invoice'],
            'data_contact_id' => $data['data_contact_id'],
            'total_harga' => $data['total'],
            'keterangan' => $data['description'],
            'company_id' => $data['company_id'],
            'warehouse_id' => $data['warehouse_id']
        ]);
        $konsinyasi->items()->sync($new_array);
        return response()->json(['data' => ['konsinyasi' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil mengubah data konsinyasi!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konsinyasi = Konsinyasi::find($id);
        $konsinyasi->items()->detach();
        $konsinyasi->delete();
        return response()->json(['status' => TRUE, 'message' => 'Berhasil menghapus data konsinyasi!']);
    }
}
