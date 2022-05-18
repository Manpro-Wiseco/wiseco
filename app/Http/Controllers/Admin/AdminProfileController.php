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

class AdminProfileController extends Controller
{
    public function index()
    {
        $sessionCode = auth()->user()->id;
        $nameProfil  = USER::where('id', $sessionCode)->get();
        return view('admin.profile.index',compact('nameProfil'));
    }
}
