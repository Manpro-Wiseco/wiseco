<?php

namespace App\Http\Controllers\User\Pelaporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sessionCompany = session()->get('company');
        return view('user.pelaporan.home', compact('sessionCompany'));
    }
}
