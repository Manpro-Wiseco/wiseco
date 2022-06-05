<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DataContact;
use App\Models\PenerimaanBarang;
use App\Models\PesananPembelian;
use App\Models\Item;
use App\Models\Company;
use App\Models\Chat;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use DateTime;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $sessionCompany = $request->session()->get('company');

        //Penjualan
        $Penjualan       = DB::table('penjualan')->where('company_id',session()->get('company')->id)->where('status','Diterima')->sum('nilai');
        $totalPenjualan  = "Rp " . number_format($Penjualan,2,',','.');
        $totalTransPenjualan  = DB::table('penjualan')->where('status', 'Diterima')->where('company_id',session()->get('company')->id)->count();
        $jumlahCustomer  = DB::table('pesanan_penjualan')->where('status', 'Diterima')->where('company_id',session()->get('company')->id)->count(DB::raw('DISTINCT pelanggan_id'));
        $jumlahDijual    =  DB::table('pesanan_penjualan')
        ->join('item_penjualan', 'item_penjualan.pesanan_penjualan_id', '=', 'pesanan_penjualan.id')
        ->where('pesanan_penjualan.status', 'Diterima')
        ->where('pesanan_penjualan.company_id', session()->get('company')->id)
        ->sum('item_penjualan.jumlah_barang');
        
        //Pembelian
        $Pembelian       = PenerimaanBarang::where('company_id',session()->get('company')->id)->where('status','Ópen')->sum('total');
        $totalPembelian  = "Rp " . number_format($Pembelian,2,',','.');
        $totalTransaksi  = PesananPembelian::where('status', 'Diterima')->where('company_id',session()->get('company')->id)->count();
        $jumlahSupplier  = PenerimaanBarang::where('company_id',session()->get('company')->id)->count(DB::raw('DISTINCT data_contact_id'));
        $jumlahDibeli    = DB::table('penerimaan_barangs')
        ->join('item_pembelian', 'item_pembelian.pembelian_id', '=', 'penerimaan_barangs.pesanan_id')
        ->where('penerimaan_barangs.status', 'Open')
        ->where('penerimaan_barangs.company_id', session()->get('company')->id)
        ->sum('item_pembelian.jumlah_barang');
        return view('user.dashboard', compact('sessionCompany','totalPenjualan','jumlahCustomer','totalTransPenjualan','jumlahDijual','totalPembelian','jumlahSupplier','totalTransaksi','jumlahDibeli'));
    }

    public function inbox($id)
    {
        $data = Company::join('users', 'companies.user_id', '=', 'users.id')->get(['companies.*','users.name AS username']);
        $company = $data->find($id);
        $chats_ = Chat::join('companies', 'chats.company_id', '=', 'companies.id')->join('users', 'chats.user_id', '=', 'users.id')->orderBy('id', 'ASC')->get(['chats.*','users.name']);
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
