<?php

namespace App\Http\Controllers\User\Pelaporan;

use App\Http\Controllers\Controller;
use App\Models\PengirimanBarang;
use App\Models\Penjualan;
use App\Models\PesananPenjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('user.pelaporan.penjualan.index');
    }

    public function pesanan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->tanggal === "year") {
            // get penjualan table from database this year
            $data = PesananPenjualan::withCount('item')->with(['item', 'pelanggan'])->currentCompany()->whereYear('created_at', date('Y'))->get();
        } elseif ($request->tanggal === "month") {
            // get penjualan table from database this month
            $data = PesananPenjualan::withCount('item')->with(['item', 'pelanggan'])->currentCompany()->whereMonth('created_at', date('m'))->get();
        } elseif ($request->tanggal === "custom") {
            // get penjualan table from database this range
            $data = PesananPenjualan::withCount('item')->with(['item', 'pelanggan'])->currentCompany()->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])->get();
        } elseif ($request->tanggal === "week") {
            // get penjualan table from database this week
            $data = PesananPenjualan::withCount('item')->with(['item', 'pelanggan'])->currentCompany()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } else {
            // get penjualan table from database this date
            $data = PesananPenjualan::withCount('item')->with(['item', 'pelanggan'])->currentCompany()->whereDate('created_at', date('Y-m-d'))->get();
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

        $pdf = PDF::loadView('user.pelaporan.penjualan.pesanan-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-riwayat-pesanan-penjualan.pdf');
    }

    public function pengiriman(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->tanggal === "year") {
            // get penjualan table from database this year
            $data = PengirimanBarang::with(['penjualan'])->currentCompany()->whereYear('created_at', date('Y'))->get();
        } elseif ($request->tanggal === "month") {
            // get penjualan table from database this month
            $data = PengirimanBarang::with(['penjualan'])->currentCompany()->whereMonth('created_at', date('m'))->get();
        } elseif ($request->tanggal === "custom") {
            // get penjualan table from database this range
            $data = PengirimanBarang::with(['penjualan'])->currentCompany()->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])->get();
        } elseif ($request->tanggal === "week") {
            // get penjualan table from database this week
            $data = PengirimanBarang::with(['penjualan'])->currentCompany()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } else {
            // get penjualan table from database this date
            $data = PengirimanBarang::with(['penjualan'])->currentCompany()->whereDate('created_at', date('Y-m-d'))->get();
        }

        $data_request = $request->all();

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

        $pdf = PDF::loadView('user.pelaporan.penjualan.pengiriman-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-riwayat-pengiriman-penjualan.pdf');
    }
}
