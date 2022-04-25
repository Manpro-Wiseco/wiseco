<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use App\Models\TicketResponse;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AdminUserTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_table.index');
    }

    public function list(Request $request)
    {
        $data = User::all();
        // $data = User::join('companies', 'users.id', '=', 'companies.user_id')->get(['companies.*', 'users.*']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($row) {
                return ($row->name ? $row->name : "-");
            })
            ->editColumn('email', function ($row) {
                return ($row->email ? $row->email : "-");
            })
            ->addColumn('jumlah', function ($row) {
                $id_user = $row->id;
                $sum = Company::where('user_id',$id_user)->get();
                $sum = $sum->count();
                return ($sum);
            })
            ->rawColumns(['jumlah'])
            ->make(true);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
