<?php

namespace App\Http\Controllers\User\Pelaporan;

use App\Http\Controllers\Controller;
use App\Models\Classification;
use App\Models\DataAccount;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            } elseif ($request->tanggal === "custom") {
                // get expenses data from database this week
                $data = Expense::with(['dataAccounts', 'fromAccount'])->where('data_contact_id', $request->data_contact_id)
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
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
            } elseif ($request->tanggal === "custom") {
                // get expenses data from database this week
                $data = Expense::with(['dataAccounts', 'fromAccount'])
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->get();
            } else {
                // get expenses data from database this day
                $data = Expense::with(['dataAccounts', 'fromAccount'])->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->whereDay('created_at', date('d'))
                    ->get();
            }
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
        // dd($data_request);

        $pdf = PDF::loadView('user.pelaporan.keuangan.pengeluaran-pdf', compact('data', 'data_request', 'tanggal'));
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
                // get income data from database this year
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->get();
            } elseif ($request->tanggal === "month") {
                // get income data from database this month
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->get();
            } elseif ($request->tanggal === "custom") {
                // get income data from database this range
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->where('data_contact_id', $request->data_contact_id)
                    ->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } elseif ($request->tanggal === "week") {
                // get income data from database this week
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->where('data_contact_id', $request->data_contact_id)
                    ->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } else {
                // get income data from database this date
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->where('data_contact_id', $request->data_contact_id)
                    ->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->whereDay('created_at', date('d'))
                    ->get();
            }
        } else {
            if ($request->tanggal === "year") {
                // get income data from database this year
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->whereYear('created_at', date('Y'))
                    ->get();
            } elseif ($request->tanggal === "month") {
                // get income data from database this month
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->whereYear('created_at', date('Y'))
                    ->whereMonth('created_at', date('m'))
                    ->get();
            } elseif ($request->tanggal === "custom") {
                // get income data from database this range
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } elseif ($request->tanggal === "week") {
                // get income data from database this week
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()
                    ->whereBetween('created_at', [$request->dari_tanggal, $request->hingga_tanggal])
                    ->get();
            } else {
                // get income data from database this date
                $data = Income::with(['dataAccounts', 'toAccount'])->currentCompany()->whereDate('created_at', date('Y-m-d'))->get();
            }
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
        // dd($data_request);

        $pdf = PDF::loadView('user.pelaporan.keuangan.pemasukan-pdf', compact('data', 'data_request', 'tanggal'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-jurnal-pengeluaran.pdf');
        // return view('user.pelaporan.keuangan.pemasukan-pdf', compact('data', 'data_request'));
    }

    public function data_accounts(Request $request)
    {
        $request->validate([
            'is_cash' => 'required'
        ]);
        if ($request->is_cash == 1) {
            $data = DataAccount::with(['dataBank', 'subclassification'])->currentCompany()->where('is_cash', 1)->get();
        } elseif ($request->is_cash == 2) {
            $data = DataAccount::with(['dataBank', 'subclassification'])->currentCompany()->get();
        } else {
            $data = DataAccount::where('is_cash', 0)->currentCompany()->get();
        }
        $pdf = PDF::loadView('user.pelaporan.keuangan.data-accounts-pdf', compact('data'));
        return $pdf->stream(Carbon::now()->format('Y-m-d') . '-data-accounts.pdf');
    }
}
