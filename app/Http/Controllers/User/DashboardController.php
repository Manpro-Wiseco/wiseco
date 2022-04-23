<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Company;
use App\Models\Chat;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use DateTime;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sessionCompany = $request->session()->get('company');


        return view('user.dashboard', compact('sessionCompany'));
    }

    public function inbox($id)
    {
        $data = Company::join('users', 'companies.user_id', '=', 'users.id')->get(['companies.*','users.name AS username']);
        $company = $data->find($id);
        $chats_ = Chat::join('companies', 'chats.company_id', '=', 'companies.id')->join('users', 'chats.user_id', '=', 'users.id')->get(['chats.*','users.name']);
        $chats = $chats_->where('company_id',$id);
        if(session()->get('company')->id == $id){
            return view('user.inbox.index',compact('company','chats'));
        }else{
            abort(403);
        }
    }

    public function submit(Request $request)
    {
        // @dd($request);
        $request->validate([
            'chat' => 'required'
        ]);

        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'company_id', $request->company_id);
        $data = Arr::add($data, 'user_id', auth()->user()->id);
        $data = Arr::add($data, 'created_at',  Carbon::now()->timestamp);
        $data = Arr::add($data, 'updated_at',  Carbon::now()->timestamp);

        Chat::create($data);

        return redirect()->route('inbox',$request->company_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function hapus($id)
    {
        $chat = Chat::find($id);
        
        $data_id  = $chat->company_id;
        $chat->delete();
        return redirect()->route('inbox',$data_id);
    }
     
}
