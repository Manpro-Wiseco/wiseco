<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use App\Models\TicketResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AdminTicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kategori_tiket.index');
    }

    public function list(Request $request)
    {
        $data = TicketCategory::all();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('category', function ($row) {
                $data = htmlspecialchars_decode($row->category);

                return ($data);
            })
            ->addColumn('action', function ($row) {
                $urlEdit = route('admin.ticketcategory.edit', $row->id);
                $actionBtn = '
                <a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small mt-2">
                <i class="fas fa-edit"></i>
                </a>
                <button class="btn bg-gradient-danger btn-small btn-delete mt-2" data-id="' . $row->id . '" type="button">
                <i class="fas fa-trash"></i>
                </button>';
                return $actionBtn;
            })
            ->rawColumns(['category','action'])
            ->make(true);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = TicketCategory::all();
        return view('admin.kategori_tiket.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @dd($request);
        $request->validate([
            'category' => 'required'
        ]);

        $data = Arr::except($request->all(), '_token');
        // $data = Arr::add($data, 'category', $request->ticket_category);
        $data = Arr::add($data, 'created_at',  Carbon::now()->timestamp);
        $data = Arr::add($data, 'updated_at',  Carbon::now()->timestamp);

        TicketCategory::create($data);

        return redirect()->route('admin.ticketcategory.index')->with('success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketCategory $ticketcategory)
    {
        $data    = Ticket::join('users', 'tickets.user_id', '=', 'users.id')->get(['tickets.*','users.name']);
        $userId  = auth()->user()->id;
        $categories = TicketCategory::all();
        return view('admin.kategori_tiket.edit', compact('ticketcategory'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketCategory $ticketcategory)
    {
        $request->validate([
            'category' => 'required'
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'updated_at',  Carbon::now()->timestamp);

        $ticketcategory->update($data);

        return redirect()->route('admin.ticketcategory.index')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCategory $ticketcategory)
    {
        $id_category = $ticketcategory->id;

        Ticket::where('ticket_category_id', $id_category)->delete();
        $ticketcategory->delete();
        
        return response()->json(['status' => TRUE]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}
