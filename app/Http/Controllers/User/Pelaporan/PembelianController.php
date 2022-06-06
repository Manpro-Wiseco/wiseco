<?php

namespace App\Http\Controllers\User\Pelaporan;

use App\Http\Controllers\Controller;
use App\Models\PenerimaanBarang;
use App\Models\PesananPembelian;
use App\Models\ReturPembelian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PembelianController extends Controller
{
    public function index()
    {
        return view('user.pelaporan.pembelian.index');
    }

    public function pesanan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->tanggal === "year") {
            // get pembelian table from database this year
            $data = PesananPembelian::withCount('items')->with(['items', 'pelanggan'])->currentCompany()->whereYear('created_at', date('Y'))->get();
        } elseif ($request->tanggal === "month") {
            // get pembelian table from database this month
            $data = PesananPembelian::withCount('items')->with(['items', 'pelanggan'])->currentCompany()->whereMonth('created_at', date('m'))->get();
        } elseif ($request->tanggal === "custom") {
            // get pembelian table from database this range
            $data = PesananPembelian::withCount('items')->with(['items', 'pelanggan'])->currentCompany()->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])->get();
        } elseif ($request->tanggal === "week") {
            // get pembelian table from database this week
            $data = PesananPembelian::withCount('items')->with(['items', 'pelanggan'])->currentCompany()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } else {
            // get pembelian table from database this date
            $data = PesananPembelian::withCount('items')->with(['items', 'pelanggan'])->currentCompany()->whereDate('created_at', date('Y-m-d'))->get();
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

        $pdf = PDF::loadView('user.pelaporan.pembelian.pesanan-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-riwayat-pesanan-pembelian.pdf');
    }

    public function penerimaan(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->tanggal === "year") {
            // get pembelian table from database this year
            $data = PenerimaanBarang::currentCompany()->whereYear('created_at', date('Y'))->get();
        } elseif ($request->tanggal === "month") {
            // get pembelian table from database this month
            $data = PenerimaanBarang::currentCompany()->whereMonth('created_at', date('m'))->get();
        } elseif ($request->tanggal === "custom") {
            // get pembelian table from database this range
            $data = PenerimaanBarang::currentCompany()->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])->get();
        } elseif ($request->tanggal === "week") {
            // get pembelian table from database this week
            $data = PenerimaanBarang::currentCompany()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } else {
            // get pembelian table from database this date
            $data = PenerimaanBarang::currentCompany()->whereDate('created_at', date('Y-m-d'))->get();
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

        $pdf = PDF::loadView('user.pelaporan.pembelian.penerimaan-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-riwayat-penerimaan-pembelian.pdf');
    }

    public function retur(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->tanggal === "year") {
            // get pembelian table from database this year
            $data = ReturPembelian::with(['dataContact'])->currentCompany()->whereYear('created_at', date('Y'))->get();
        } elseif ($request->tanggal === "month") {
            // get pembelian table from database this month
            $data = ReturPembelian::with(['dataContact'])->currentCompany()->whereMonth('created_at', date('m'))->get();
        } elseif ($request->tanggal === "custom") {
            // get pembelian table from database this range
            $data = ReturPembelian::with(['dataContact'])->currentCompany()->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])->get();
        } elseif ($request->tanggal === "week") {
            // get pembelian table from database this week
            $data = ReturPembelian::with(['dataContact'])->currentCompany()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        } else {
            // get pembelian table from database this date
            $data = ReturPembelian::with(['dataContact'])->currentCompany()->whereDate('created_at', date('Y-m-d'))->get();
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

        $pdf = PDF::loadView('user.pelaporan.pembelian.retur-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-riwayat-retur-pembelian.pdf');
    }
}
