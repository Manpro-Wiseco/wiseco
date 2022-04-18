<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->session()->get('user');

        return view('admin.dashboard', compact('sessionId'));
    }
}
