<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DateTime;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->session()->get('user');
        $totalTicket = Ticket::all()->count();
        $openTicket = Ticket::where('status','open')->count();
        $closeTicket = Ticket::where('status','close')->count();
        $totalUser = User::all()->count();
        $adminUser = User::where('role_id',1)->count();
        $clientUser = User::where('role_id',2)->count();
        $totalUMKM = Company::all()->count();
        return view('admin.dashboard', compact(['sessionId','totalTicket','openTicket','closeTicket','totalUser','adminUser','clientUser','totalUMKM']));
    }
}
