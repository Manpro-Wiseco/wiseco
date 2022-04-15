<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\Subclassification;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class SubclassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function data(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = Subclassification::all();
        } else {
            $data = Subclassification::where('name', 'like', '%' . $search . '%')->get();
        }
        return response()->json($data);
    }

    public function list(Request $request, Classification $classification)
    {
        $data = $classification->subclassification()->currentCompany()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('count_account', function ($row) {
                return $row->dataAccount->count();
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('subclassification.edit', $row->id);
                if ($row->company_id == null) {
                    return "";
                } else {
                    $actionBtn = '
                    <button class="btn bg-gradient-info btn-small btn-edit" data-id="' . $row->id . '" data-name="' . $row->name . '" type="button">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn bg-gradient-danger btn-small btn-delete" data-id="' . $row->id . '" data-name="' . $row->name . '" type="button">
                        <i class="fas fa-trash"></i>
                    </button>';
                    return $actionBtn;
                }
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
        return view('user.data-lainnya.classification.index');
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
            'code' => 'required',
        ]);
        $data = Arr::add($request->all(), 'company_id', session()->get('company')->id);
        Subclassification::create($data);
        return response()->json(['data' => $data, 'success' => TRUE]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subclassification = Subclassification::findOrFail($id);
        return response()->json($subclassification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subclassification = Subclassification::findOrFail($id);
        return response()->json($subclassification);
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
        $subclassification = Subclassification::findOrFail($id);
        $subclassification->dataAccount()->delete();
        $subclassification->delete();
        return response()->json(['success' => TRUE]);
    }
}
