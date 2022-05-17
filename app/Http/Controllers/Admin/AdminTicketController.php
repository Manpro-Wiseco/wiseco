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

class AdminTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tiket.index');
    }

    public function list(Request $request)
    {
        $data = Ticket::join('ticket_categories', 'tickets.ticket_category_id', '=', 'ticket_categories.id')->join('users', 'tickets.user_id', '=', 'users.id')->get(['tickets.*', 'ticket_categories.category','users.name']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('category', function ($row) {
                return ($row->category ? $row->category : "-");
            })
            ->addColumn('time', function ($row) {
                $time = $row->updated_at;
                $time_ = Carbon::parse($time)->format("d/m/Y");
                return ($time_);
            })
            ->addColumn('status', function ($row) {
                if ($row->status == 'close') {
                    $actionBtn = '<h5 class="btn bg-gradient-secondary btn-small mt-2 disabled">close</h5>';
                  }elseif ($row->status == 'open') {
                    $actionBtn = '<h5 class="btn bg-gradient-success btn-small mt-2 disabled">open</h5>';
                  }
                return ($actionBtn);
            })
            ->editColumn('name', function ($row) {
                return ($row->name ? $row->name : "-");
            })
            ->addColumn('action', function ($row) {
                $urlView = route('admin.ticket.view', $row->id);
                $urlEdit = route('admin.ticket.edit', $row->id);
                $userId  = auth()->user()->id;
                $actionBtn = '
                <a href="' . $urlView . '" class="btn bg-gradient-success btn-small mt-2">
                <i class="fas fa-eye"></i>
                </a>
                <a href="' . $urlEdit . '" class="btn bg-gradient-info btn-small mt-2">
                <i class="fas fa-edit"></i>
                </a>
                <button class="btn bg-gradient-danger btn-small btn-delete mt-2" data-id="' . $row->id . '" type="button">
                <i class="fas fa-trash"></i>
                </button>';
                return $actionBtn;
            })
            ->rawColumns(['action','status','category','time'])
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
        return view('admin.tiket.create',compact('categories'));
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
            'status' => 'required',
            'body' => 'required'
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'ticket_category_id', $request->ticket_category);
        $data = Arr::add($data, 'user_id', auth()->user()->id);
        $data = Arr::add($data, 'created_at',  Carbon::now()->timestamp);
        $data = Arr::add($data, 'updated_at',  Carbon::now()->timestamp);

        Ticket::create($data);

        return redirect()->route('admin.ticket.index')->with('success', 'Berhasil Menambahkan Data!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $data    = Ticket::join('users', 'tickets.user_id', '=', 'users.id')->get(['tickets.*','users.name']);
        $userId  = auth()->user()->id;
        $categories = TicketCategory::all();
        if ($ticket->user_id == $userId ) {
            return view('admin.tiket.edit', compact('ticket','categories'));
        }else{
            return view('admin.tiket.edit', compact('ticket','categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required',
            'body' => 'required'
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'ticket_category_id', $request->ticket_category);
        $data = Arr::add($data, 'updated_at',  Carbon::now()->timestamp);

        $ticket->update($data);

        return redirect()->route('admin.ticket.index')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $id_ticket = $ticket->id;

        TicketResponse::where('ticket_id', $id_ticket)->delete();
        $ticket->delete();
        
        return response()->json(['status' => TRUE]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $data = Ticket::join('ticket_categories', 'tickets.ticket_category_id', '=', 'ticket_categories.id')->join('users', 'tickets.user_id', '=', 'users.id')->get(['tickets.*', 'ticket_categories.category','users.name']);
        $ticket = $data->find($id);
        $ticket_responses_ = TicketResponse::join('tickets', 'ticket_responses.ticket_id', '=', 'tickets.id')->join('users', 'ticket_responses.user_id', '=', 'users.id')->get(['ticket_responses.*', 'tickets.body','users.name']);
        $ticket_responses = $ticket_responses_->where('ticket_id',$id);
        return view('admin.tiket.view', compact('ticket','ticket_responses'));
    }

}
