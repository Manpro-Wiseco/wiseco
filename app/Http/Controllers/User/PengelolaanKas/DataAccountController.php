<?php

namespace App\Http\Controllers\User\PengelolaanKas;

use App\Http\Controllers\Controller;
use App\Models\DataAccount;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;

class DataAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pengelolaan-kas.data-account.index');
    }

    public function list(Request $request)
    {
        $data = DataAccount::with(['dataBank', 'subclassification', 'company'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bank', function ($row) {
                return $row->dataBank ? $row->dataBank->name : '-';
            })
            ->editColumn('status', function ($row) {
                return $row->status == 1 ? "Bisnis" : "Pribadi";
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('pengelolaan-kas.data-account.edit', $row->id);
                $urlShow = route('pengelolaan-kas.data-account.show', $row->id);
                $actionBtn = '
                <a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
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

    public function data(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = DataAccount::currentCompany()->get();
        } else {
            $data = DataAccount::currentCompany()->where('name', 'like', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($data as $d) {
            $response[] = array(
                "id" => $d->id,
                "text" => $d->name,
            );
        }
        return response()->json($response);
    }

    public function dataOnlyIsCash(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = DataAccount::currentCompany()->where('is_cash', '=', 1)->get();
        } else {
            $data = DataAccount::currentCompany()->where('is_cash', '=', 1)->where('name', 'like', '%' . $search . '%')->get();
        }
        $response = array();
        foreach ($data as $d) {
            $response[] = array(
                "id" => $d->id,
                "text" => $d->name,
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
        return view('user.pengelolaan-kas.data-account.create');
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
            'name' => 'required',
            'subclassification_id' => 'required',
            'data_bank_id' => 'required|sometimes',
            'status' => 'required',
            'is_cash' => 'required|sometimes',
        ]);
        $data = Arr::except($request->all(), '_token');
        if ($request->has('is_cash')) {
            $data = Arr::except($data, 'is_cash');
            $data = Arr::add($data, 'is_cash', 1);
        } else {
            $data = Arr::add($data, 'is_cash', 0);
        }
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        DataAccount::create($data);

        return redirect()->route('pengelolaan-kas.data-account.index')->with('success', 'Berhasil Menambahkan Data Akun Baru!');
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
    public function edit(DataAccount $dataAccount)
    {
        return view('user.pengelolaan-kas.data-account.edit', compact('dataAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataAccount $dataAccount)
    {
        $request->validate([
            'name' => 'required',
            'subclassification_id' => 'required',
            'data_bank_id' => 'required|sometimes',
            'status' => 'required',
            'is_cash' => 'required|sometimes',
        ]);
        $data = Arr::except($request->all(), '_token');
        if ($request->has('is_cash')) {
            $data = Arr::except($data, 'is_cash');
            $data = Arr::add($data, 'is_cash', 1);
        } else {
            $data = Arr::add($data, 'is_cash', 0);
        }
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        $dataAccount->update($data);
        return redirect()->route('pengelolaan-kas.data-account.index')->with('success', 'Berhasil Mengubah Data Akun!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataAccount $bankAccount)
    {
        $bankAccount->expenses->delete();
        $bankAccount->delete();
        return response()->json(['status' => TRUE]);
    }
}
