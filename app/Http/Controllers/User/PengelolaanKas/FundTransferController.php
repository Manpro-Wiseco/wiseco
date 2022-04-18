<?php

namespace App\Http\Controllers\User\PengelolaanKas;

use App\Http\Controllers\Controller;
use App\Models\DataAccount;
use App\Models\FundTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class FundTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.pengelolaan-kas.fund-transfer.index');
    }

    public function list(Request $request)
    {
        $data = FundTransfer::with(['fromDataAccounts', 'toDataAccounts'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('from', function ($row) {
                return $row->fromDataAccounts->name;
            })
            ->addColumn('to', function ($row) {
                return $row->toDataAccounts->name;
            })
            ->addColumn('total_text', function ($row) {
                return "Rp " . number_format($row->total, 2, ',', '.');
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('pengelolaan-kas.fund-transfer.edit', $row->id);
                $urlShow = route('pengelolaan-kas.fund-transfer.show', $row->id);
                $actionBtn = '
                <a href="' . $urlShow . '" class="btn bg-gradient-success btn-small">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small">
                    <i class="fas fa-edit"></i>
                </a>
                
    <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" data-invoice="' . $row->invoice . '" type="button">
        <i class="fas fa-trash"></i>
    </button>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fromBank(Request $request)
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

    public function toBank(Request $request)
    {
        $search = $request->search;
        $fromBank = $request->fromBank;
        if ($search == '') {
            if ($fromBank) {
                $data = DataAccount::currentCompany()->where('is_cash', '=', 1)->where('id', '!=', $fromBank)->get();
            } else {
                $data = DataAccount::currentCompany()->where('is_cash', '=', 1)->get();
            }
        } else {
            if ($fromBank) {
                $data = DataAccount::currentCompany()->where('is_cash', '=', 1)->where('name', 'like', '%' . $search . '%')->where('id', '!=', $fromBank)->get();
            } else {
                $data = DataAccount::currentCompany()->where('is_cash', '=', 1)->where('name', 'like', '%' . $search . '%')->get();
            }
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
        return view('user.pengelolaan-kas.fund-transfer.create');
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
            'invoice' => 'required',
            'description' => 'required',
            'toBank' => 'required|numeric',
            'fromBank' => 'required|numeric',
            'total' => 'required|numeric',
            'transaction_date' => 'required'
        ]);

        FundTransfer::create([
            'invoice' => $request->invoice,
            'description' => $request->description,
            'from_bank_account' => $request->fromBank,
            'to_bank_account' => $request->toBank,
            'total' => $request->total,
            'transaction_date' => $request->transaction_date,
            'company_id' => session()->get('company')->id
        ]);

        return redirect()->route('pengelolaan-kas.fund-transfer.index')->with('success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fundTransfer = FundTransfer::with(['fromDataAccounts', 'toDataAccounts'])->findOrFail($id);
        $company = session()->get('company');
        return view('user.pengelolaan-kas.fund-transfer.show', compact('fundTransfer', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FundTransfer $fundTransfer)
    {
        return view('user.pengelolaan-kas.fund-transfer.edit', compact('fundTransfer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FundTransfer $fundTransfer)
    {
        $request->validate([
            'invoice' => 'required',
            'description' => 'required',
            'toBank' => 'required|numeric',
            'fromBank' => 'required|numeric',
            'total' => 'required|numeric',
            'transaction_date' => 'required'
        ]);

        $fundTransfer->update([
            'invoice' => $request->invoice,
            'description' => $request->description,
            'from_bank_account' => $request->fromBank,
            'to_bank_account' => $request->toBank,
            'total' => $request->total,
            'transaction_date' => $request->transaction_date
        ]);

        return redirect()->route('pengelolaan-kas.fund-transfer.index')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FundTransfer $fundTransfer)
    {
        $fundTransfer->delete();
        return response()->json(['status' => TRUE]);
    }
}
