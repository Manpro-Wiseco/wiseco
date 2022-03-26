<?php

namespace App\Http\Controllers\User\Inventory;

use App\Http\Controllers\Controller;
use App\Models\DataProduk;
use App\Models\Expense;
use Illuminate\Http\Request;
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
        $data = Expense::with(['bankAccounts', 'dataContact'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('penerima', function ($row) {
                return $row->dataContact->name;
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('inventory.data-produk.edit', $row->id);
                $actionBtn = '<a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
        <i class="fas fa-edit"></i>
    </a>
    <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" data-name="' . $row->name . '" type="button">
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(DataProduk $dataProduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataProduk $dataProduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataProduk  $dataProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataProduk $dataProduk)
    {
        //
    }
}
