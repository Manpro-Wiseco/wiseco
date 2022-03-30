<?php

namespace App\Http\Controllers\User\PengelolaanKas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.pengelolaan-kas.home');
    }
}
