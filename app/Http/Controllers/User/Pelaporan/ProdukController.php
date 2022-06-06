<?php

namespace App\Http\Controllers\User\Pelaporan;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\PesananPenjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        return view('user.pelaporan.produk.index');
    }

    public function produk(Request $request)
    {
        $data = Item::currentCompany()->get();

        $pdf = PDF::loadView('user.pelaporan.produk.produk-pdf', compact('data'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-laporan-produk.pdf');
    }

    public function produk_jual(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->tanggal === "year") {
            // get item penjualan table from database this year
            $data = DB::table('items')->selectRaw('item_penjualan.*, items.*, SUM(item_penjualan.jumlah_barang) AS barang_terjual, SUM(item_penjualan.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_penjualan', 'items.id', '=', 'item_penjualan.item_id')->whereYear('items.created_at', date('Y'))->groupBy('items.id')->get();
        } elseif ($request->tanggal === "month") {
            // get item penjualan table from database this month
            $data = DB::table('items')->selectRaw('item_penjualan.*, items.*, SUM(item_penjualan.jumlah_barang) AS barang_terjual, SUM(item_penjualan.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_penjualan', 'items.id', '=', 'item_penjualan.item_id')->whereMonth('items.created_at', date('m'))->groupBy('items.id')->get();
        } elseif ($request->tanggal === "custom") {
            // get item penjualan table from database this range
            $data = DB::table('items')->selectRaw('item_penjualan.*, items.*, SUM(item_penjualan.jumlah_barang) AS barang_terjual, SUM(item_penjualan.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_penjualan', 'items.id', '=', 'item_penjualan.item_id')->whereBetween('items.created_at', [$request->dari_tanggal, $request->hingga_tanggal])->groupBy('items.id')->get();
        } elseif ($request->tanggal === "week") {
            // get item penjualan table from database this week
            $data = DB::table('items')->selectRaw('item_penjualan.*, items.*, SUM(item_penjualan.jumlah_barang) AS barang_terjual, SUM(item_penjualan.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_penjualan', 'items.id', '=', 'item_penjualan.item_id')->whereBetween('items.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->groupBy('items.id')->get();
        } else {
            // get item penjualan table from database this date
            $data = DB::table('items')->selectRaw('item_penjualan.*, items.*, SUM(item_penjualan.jumlah_barang) AS barang_terjual, SUM(item_penjualan.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_penjualan', 'items.id', '=', 'item_penjualan.item_id')->whereDate('items.created_at', date('Y-m-d'))->groupBy('items.id')->get();
        }


        if ($request->tanggal === "year") {
            $tanggal = date('Y');
        } else if ($request->tanggal === "month") {
            $tanggal = date('m');
        } else if ($request->tanggal === "week") {
            $tanggal = Carbon::now()->startOfWeek()->format('d-m-Y') . ' s/d ' . Carbon::now()->endOfWeek()->format('d-m-Y');
        } else if ($request->tanggal === "custom") {
            $tanggal = $request->dari_tanggal . ' s/d ' . $request->hingga_tanggal;
        } else {
            $tanggal = date('d-m-Y');
        }

        $data_request = $request->all();

        $pdf = PDF::loadView('user.pelaporan.produk.produk-terjual-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-riwayat-produk-terjual.pdf');
    }

    public function produk_beli(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->tanggal === "year") {
            // get item pembelian table from database this year
            $data = DB::table('items')->selectRaw('item_pembelian.*, items.*, SUM(item_pembelian.jumlah_barang) AS barang_terjual, SUM(item_pembelian.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_pembelian', 'items.id', '=', 'item_pembelian.item_id')->whereYear('items.created_at', date('Y'))->groupBy('items.id')->get();
        } elseif ($request->tanggal === "month") {
            // get item pembelian table from database this month
            $data = DB::table('items')->selectRaw('item_pembelian.*, items.*, SUM(item_pembelian.jumlah_barang) AS barang_terjual, SUM(item_pembelian.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_pembelian', 'items.id', '=', 'item_pembelian.item_id')->whereMonth('items.created_at', date('m'))->groupBy('items.id')->get();
        } elseif ($request->tanggal === "custom") {
            // get item pembelian table from database this range
            $data = DB::table('items')->selectRaw('item_pembelian.*, items.*, SUM(item_pembelian.jumlah_barang) AS barang_terjual, SUM(item_pembelian.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_pembelian', 'items.id', '=', 'item_pembelian.item_id')->whereBetween('items.created_at', [$request->dari_tanggal, $request->hingga_tanggal])->groupBy('items.id')->get();
        } elseif ($request->tanggal === "week") {
            // get item pembelian table from database this week
            $data = DB::table('items')->selectRaw('item_pembelian.*, items.*, SUM(item_pembelian.jumlah_barang) AS barang_terjual, SUM(item_pembelian.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_pembelian', 'items.id', '=', 'item_pembelian.item_id')->whereBetween('items.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->groupBy('items.id')->get();
        } else {
            // get item pembelian table from database this date
            $data = DB::table('items')->selectRaw('item_pembelian.*, items.*, SUM(item_pembelian.jumlah_barang) AS barang_terjual, SUM(item_pembelian.subtotal) AS total_terjual')->where('company_id', '=', session()->get('company')->id)->join('item_pembelian', 'items.id', '=', 'item_pembelian.item_id')->whereDate('items.created_at', date('Y-m-d'))->groupBy('items.id')->get();
        }


        if ($request->tanggal === "year") {
            $tanggal = date('Y');
        } else if ($request->tanggal === "month") {
            $tanggal = date('m');
        } else if ($request->tanggal === "week") {
            $tanggal = Carbon::now()->startOfWeek()->format('d-m-Y') . ' s/d ' . Carbon::now()->endOfWeek()->format('d-m-Y');
        } else if ($request->tanggal === "custom") {
            $tanggal = $request->dari_tanggal . ' s/d ' . $request->hingga_tanggal;
        } else {
            $tanggal = date('d-m-Y');
        }

        $data_request = $request->all();

        $pdf = PDF::loadView('user.pelaporan.produk.produk-dibeli-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-riwayat-produk-dibeli.pdf');
    }
}
