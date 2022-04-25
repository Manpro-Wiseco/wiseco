<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function index()
    {
        $company = session()->get('company');
        return view('user.company-setting.index', compact('company'));
    }
}
