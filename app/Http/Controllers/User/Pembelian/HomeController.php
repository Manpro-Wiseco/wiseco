<?php

namespace App\Http\Controllers\User\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('user.pembelian.index');
    }
}
