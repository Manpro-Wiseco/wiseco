<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subclassification;
use Illuminate\Http\Request;

class SubclassificationController extends Controller
{
    public function data(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $data = Subclassification::all();
        } else {
            $data = Subclassification::where('name', 'like', '%' . $search . '%')->get();
        }
        return response()->json($data);
    }
}
