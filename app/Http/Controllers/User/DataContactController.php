<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataContact;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class DataContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.data-lainnya.data-kontak.index');
    }

    public function list(Request $request)
    {
        $data = DataContact::with(['company'])->currentCompany()->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('email', function ($row) {
                return ($row->email ? $row->email : "-");
            })
            ->editColumn('phone', function ($row) {
                return ($row->phone ? $row->phone : "-");
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('data-contact.edit', $row->id);
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

    public function data(Request $request)
    {
        $search = $request->search;
        $filter = $request->filter;
        if ($filter) {
            if ($search == '') {
                $data = DataContact::currentCompany()->where('status', $filter)->get();
            } else {
                $data = DataContact::currentCompany()->where('status', $filter)->where('name', 'like', '%' . $search . '%')->get();
            }
        } else {
            if ($search == '') {
                $data = DataContact::currentCompany()->get();
            } else {
                $data = DataContact::currentCompany()->where('name', 'like', '%' . $search . '%')->get();
            }
        }

        $response = array();
        foreach ($data as $d) {
            $response[] = [
                'id' => $d->id,
                'text' => $d->name . ' - ' . $d->status,
                'status' => $d->status,
                'email' => $d->email,
                'phone' => $d->phone,
                'company' => $d->company->name,
            ];
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
        return view('user.data-lainnya.data-kontak.create');
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
            'email' => 'required|string|email',
            'phone' => 'required|string|max:16',
            'address' => 'required|string',
            'status' => 'required|string'
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'company_id', session()->get('company')->id);

        DataContact::create($data);

        return redirect()->route('data-contact.index')->with('success', 'Berhasil Menambahkan Data!');
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
    public function edit(DataContact $dataContact)
    {
        return view('user.data-lainnya.data-kontak.edit', compact('dataContact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataContact $dataContact)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email',
            'phone' => 'required|string|max:16',
            'address' => 'required|string',
            'status' => 'required|string'
        ]);

        $data = Arr::except($request->all(), '_token');

        $dataContact->update($data);

        return redirect()->route('data-contact.index')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataContact $dataContact)
    {
        $dataContact->delete();
        return response()->json(['status' => TRUE]);
    }
}
