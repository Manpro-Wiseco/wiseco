<?php

namespace App\Http\Controllers\User\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('user.penjualan.home');
    }
}
