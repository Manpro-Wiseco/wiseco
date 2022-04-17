<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DataAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::where('user_id', auth()->user()->id)->get();
        return view('list-company', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function session(Company $company, Request $request)
    {
        $data = Company::with(['user'])->findOrFail($company->id);
        $request->session()->put('company', $data);
        return redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Arr::except($request->all(), '_token');
        $data = Arr::add($data, 'user_id', auth()->user()->id);
        if ($request->status === "Dalam Negeri") {
            $data = Arr::add($data, 'country', 'Indonesia');
        }
        $company = Company::create($data);
        $this->generateDataAccounts($company->id);
        return response()->json(['status' => TRUE, 'data' => $data]);
    }

    public function generateDataAccounts($company_id)
    {
        $data_accounts = array(
            array(
                "name" => "Bank Utama",
                "company_id" => $company_id,
                "data_bank_id" => 8,
                "subclassification_id" => 12,
                "is_cash" => 1,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Kas",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 13,
                "is_cash" => 1,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Kas Kecil",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 13,
                "is_cash" => 1,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Gopay",
                "company_id" => $company_id,
                "data_bank_id" => 142,
                "subclassification_id" => 34,
                "is_cash" => 1,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Piutang Usaha",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 1,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Piutang Karyawan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 1,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Piutang Lain",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 2,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Piutang Giro",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 2,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Persediaan Umum",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 3,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Sewa Dibayar Dimuka",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 7,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Asuransi Dibayar Dimuka",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 7,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Biaya Dibayar Dimuka Lain",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 7,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Investasi Saham",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 8,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Utang Usaha",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 14,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Utang Giro",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 15,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Utang Belum Ditagih",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 15,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Utang Pihak Ketiga",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 15,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Utang Konsinyasi",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 15,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Utang Komisi Penjualan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 15,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Utang Bank",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 18,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Modal Disetor",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 19,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Saham Biasa",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 19,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Laba ditahan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 20,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Laba Tahun Berjalan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 20,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Pendapatan Jasa",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 23,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Penjualan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 21,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Retur Penjualan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 24,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Retur Pembelian",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 26,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Pengiriman",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 37,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Pembelian Lain",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 37,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Komisi Penjualan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 27,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Piutang Tak Tertagih",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 27,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Gaji & Upah",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Staff Ahli & Perizinan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Sistem & Teknologi",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Sewa",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Listrik",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Air",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Internet & Telepon",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Perlengkapan",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 38,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Pendapatan Bunga/Bagi Hasil",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 39,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
            array(
                "name" => "Beban Pajak",
                "company_id" => $company_id,
                "data_bank_id" => NULL,
                "subclassification_id" => 17,
                "is_cash" => 0,
                "status" => 1,
                "created_at" => Carbon::now(),
            ),
        );
        DataAccount::insert($data_accounts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
