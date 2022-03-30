<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function index(Request $request)
    {
        $sessionCompany = $request->session()->get('company');
        return view('fitur-report.laporan-keuangan', compact('sessionCompany'));
    }
}