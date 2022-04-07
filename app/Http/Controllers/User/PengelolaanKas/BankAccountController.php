<?php

namespace App\Http\Controllers\User\PengelolaanKas;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pengelolaan-kas.bank-account.index');
    }

    public function list(Request $request)
    {
        $data = BankAccount::with(['dataBank', 'subclassification', 'company'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bank', function ($row) {
                return $row->dataBank->name;
            })
            ->addColumn('subclassification', function ($row) {
                return $row->subclassification->name;
            })
            ->editColumn('status', function ($row) {
                return $row->status == 1 ? "Bisnis" : "Pribadi";
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('pengelolaan-kas.bank-account.edit', $row->id);
                $urlShow = route('pengelolaan-kas.bank-account.show', $row->id);
                $actionBtn = '
                <a href="' . $urlShow . '" class="btn bg-gradient-success btn-small">
                    <i class="fas fa-eye"></i>
                </a>
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
            $data = BankAccount::currentCompany()->get();
        } else {
            $data = BankAccount::currentCompany()->where('name', 'like', '%' . $search . '%')->get();
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
        return view('user.pengelolaan-kas.bank-account.create');
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
            'data_bank_id' => 'required',
            'status' => 'required'
        ]);
        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);
        BankAccount::create($data);

        return redirect()->route('pengelolaan-kas.bank-account.index')->with('success', 'Berhasil Menambahkan Data!');
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
    public function edit(BankAccount $bankAccount)
    {
        return view('user.pengelolaan-kas.bank-account.edit', compact('bankAccount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        $request->validate([
            'name' => 'required',
            'subclassification_id' => 'required',
            'data_bank_id' => 'required',
            'status' => 'required'
        ]);

        $data = Arr::except($request->all(), '_token');
        $bankAccount->update($data);
        return redirect()->route('pengelolaan-kas.bank-account.index')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->expenses->delete();
        $bankAccount->delete();
        return response()->json(['status' => TRUE]);
    }
}
