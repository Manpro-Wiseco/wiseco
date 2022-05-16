<?php

namespace App\Http\Controllers\User\Inventory;

use App\Http\Controllers\Controller;
use App\Models\DataProduk;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class DataProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.inventory.data-produk.index');
    }

    public function list(Request $request)
    {
        $data = Item::with(['konsinyasi', 'adjustments'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('quantitasItem', function ($row) {
                return ($row->adjustments->sum('pivot.jumlah_barang') - $row->konsinyasi->sum('pivot.jumlah_barang')) . " " . $row->unitItem;
            })
            ->addColumn('hargaJual', function ($row) {
                return "Rp " . number_format($row->priceItem, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('inventory.data-produk.edit', $row->id);
                $actionBtn = '<a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                                  <i class="fas fa-edit"></i>
                              </a>
                            <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" data-name="' . $row->nameItem . '" type="button">
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
            $data = Item::currentCompany()->get();
        } else {
            $data = Item::currentCompany()->where('nameItem', 'like', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($data as $d) {
            $response[] = array(
                "id" => $d->id,
                "text" => $d->nameItem,
                "price" => $d->priceItem,
                "unit" => $d->unitItem
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
        return view('user.inventory.data-produk.create');
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
            'nameItem' => 'required',
            'codeItem' => 'required',
            'unitItem' => 'required',
            'descriptionItem' => 'required',
            'priceItem' => 'required|numeric',
            'costItem' => 'required|numeric',
        ]);
        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        Item::create($data);
        return redirect()->route('inventory.data-produk.index')->with('success', 'Berhasil Menambahkan Data Item Baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function show(DataProduk $dataProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $dataProduk)
    {
        return view('user.inventory.data-produk.edit', compact('dataProduk'));
        // dd($dataProduk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $dataProduk)
    {
        $request->validate([
            'nameItem' => 'required',
            'codeItem' => 'required',
            'unitItem' => 'required',
            'descriptionItem' => 'required',
            'priceItem' => 'required|numeric',
            'costItem' => 'required|numeric',
        ]);
        $data = Arr::except($request->all(), '_token');
        $dataProduk->update($data);
        return redirect()->route('inventory.data-produk.index')->with('success', 'Berhasil Mengubah Data Item Baru!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $dataProduk)
    {
        $dataProduk->delete();
        return response()->json(['status' => TRUE]);
    }
}
