<?php

namespace App\Http\Controllers\User\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftardanPembayaranUtangController extends Controller
{
    public function index(Request $request)
    {
        $sessionCompany = $request->session()->get('company');
        return view('fitur-pembelian.Daftar-Pembayaran-Utang', compact('sessionCompany'));
    }
}