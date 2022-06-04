<?php

namespace App\Http\Controllers\User\Pelaporan;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    public function index()
    {
        return view('user.pelaporan.keuangan.index');
    }

    public function pengeluaran(Request $request)
    {
        $request->validate([
            'data_contact_id' => 'required',
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->data_contact_id > 0) {
            if ($request->tanggal === "year") {
                // get expenses data from database this year
                $data = Expense::with(['dataAccounts', 'fromAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->get();
            } elseif ($request->tanggal === "month") {
                // get expenses data from database this month
                $data = Expense::with(['dataAccounts', 'fromAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->get();
            } elseif ($request->tanggal === "custom") {
                // get expenses data from database this range
                $data = Expense::with(['dataAccounts', 'fromAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } else {
                // get expenses data from database this day
                $data = Expense::with(['dataAccounts', 'fromAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->whereDay('created_at', date('d'))
                    ->get();
            }
        } else {
            if ($request->tanggal === "year") {
                // get expenses data from database this year
                $data = Expense::with(['dataAccounts', 'fromAccount'])->whereYear('created_at', date('Y'))
                    ->get();
            } elseif ($request->tanggal === "month") {
                // get expenses data from database this month
                $data = Expense::with(['dataAccounts', 'fromAccount'])->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->get();
            } elseif ($request->tanggal === "custom") {
                // get expenses data from database this range
                $data = Expense::with(['dataAccounts', 'fromAccount'])->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } else {
                // get expenses data from database this day
                $data = Expense::with(['dataAccounts', 'fromAccount'])->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->whereDay('created_at', date('d'))
                    ->get();
            }
        }

        $data_request = $request->all();
        // dd($data_request);

        $pdf = PDF::loadView('user.pelaporan.keuangan.pengeluaran-pdf', compact('data', 'data_request'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-jurnal-pengeluaran.pdf');
        // return view('user.pelaporan.keuangan.pengeluaran-pdf', compact('data', 'data_request'));
    }

    public function pemasukan(Request $request)
    {
        $request->validate([
            'data_contact_id' => 'required',
            'tanggal' => 'required',
            'dari_tanggal' => 'required|sometimes',
            'hingga_tanggal' => 'required|sometimes'
        ]);

        if ($request->data_contact_id > 0) {
            if ($request->tanggal === "year") {
                // get expenses data from database this year
                $data = Income::with(['dataAccounts', 'toAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->get();
            } elseif ($request->tanggal === "month") {
                // get expenses data from database this month
                $data = Income::with(['dataAccounts', 'toAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->get();
            } elseif ($request->tanggal === "custom") {
                // get expenses data from database this range
                $data = Income::with(['dataAccounts', 'toAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } else {
                // get expenses data from database this day
                $data = Income::with(['dataAccounts', 'toAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->whereDay('created_at', date('d'))
                    ->get();
            }
        } else {
            if ($request->tanggal === "year") {
                // get expenses data from database this year
                $data = Income::with(['dataAccounts', 'toAccount'])->whereYear('created_at', date('Y'))
                    ->get();
            } elseif ($request->tanggal === "month") {
                // get expenses data from database this month
                $data = Income::with(['dataAccounts', 'toAccount'])->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->get();
            } elseif ($request->tanggal === "custom") {
                // get expenses data from database this range
                $data = Income::with(['dataAccounts', 'toAccount'])->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } else {
                // get expenses data from database this day
                $data = Income::with(['dataAccounts', 'toAccount'])->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->whereDay('created_at', date('d'))
                    ->get();
            }
        }

        $data_request = $request->all();
        // dd($data_request);

        $pdf = PDF::loadView('user.pelaporan.keuangan.pemasukan-pdf', compact('data', 'data_request'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-jurnal-pengeluaran.pdf');
        // return view('user.pelaporan.keuangan.pemasukan-pdf', compact('data', 'data_request'));
    }
}
