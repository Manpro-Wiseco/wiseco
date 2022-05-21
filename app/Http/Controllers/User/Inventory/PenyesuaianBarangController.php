<?php

namespace App\Http\Controllers\User\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adjustment;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PenyesuaianBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.inventory.penyesuaian-barang.index');
    }

    public function list(Request $request)
    {
        $data = Adjustment::with(['items'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total_barang', function ($row) {
                return $row->items->count();
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('inventory.penyesuaian-barang.edit', $row->id);
                $urlShow = route('inventory.penyesuaian-barang.show', $row->id);
                $actionBtn = '
                <a href="' . $urlShow . '" class="btn bg-gradient-success btn-small">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" type="button">
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
        return view('user.inventory.penyesuaian-barang.create');
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
            'tanggal' => 'required',
            'keterangan' => 'required',
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
            $adjustment = Adjustment::create([
                'tanggal' => $data['tanggal'],
                'total' => $data['total'],
                'keterangan' => $data['keterangan'],
                'company_id' => $data['company_id']
            ]);
            foreach ($detail as $key => $value) {
                DB::table('item_adjustment')->insert([
                    "adjustment_id" => $adjustment->id,
                    "item_id" => $value["data_produk_id"],
                    "jumlah_barang" => $value["jumlah_barang"],
                    "harga_barang" => $value["priceItem"],
                    "subtotal" => $value["amount"],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ]);

                // Get items table by id
                $item = DB::table('items')->where('id', $value["data_produk_id"])->first();
                // Update stock
                DB::table('items')->where('id', $value["data_produk_id"])->update([
                    'stockItem' => $item->stockItem + $value["jumlah_barang"],
                    'updated_at' => Carbon::now()
                ]);
            }
        });

        return response()->json(['data' => ['adjustment' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil menambahkan data penyesuaian barang!']);
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
        $adjustment = Adjustment::findOrFail($id);
        return view('user.inventory.penyesuaian-barang.edit', compact('adjustment'));
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
            'tanggal' => 'required',
            'keterangan' => 'required',
            'detail.*.amount' => 'required|numeric',
            'detail.*.data_produk_id' => 'required|numeric',
            'detail.*.priceItem' => 'required|numeric'
        ]);

        $adjustment = Adjustment::find($id);
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

        $adjustment->update([
            'tanggal' => $data['tanggal'],
            'total' => $data['total'],
            'keterangan' => $data['keterangan'],
            'company_id' => $data['company_id']
        ]);
        $adjustment->items()->sync($new_array);
        return response()->json(['data' => ['adjustment' => $data, 'detail' => $detail], 'status' => TRUE, 'message' => 'Berhasil mengubah data penyesuaian barang!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adjustment = Adjustment::find($id);
        $adjustment->items()->detach();
        $adjustment->delete();
        return response()->json(['status' => TRUE, 'message' => 'Berhasil menghapus data penyesuaian barang!']);
    }
}
