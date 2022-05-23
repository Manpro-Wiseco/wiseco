<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use App\Models\Company;
use App\Models\TicketResponse;
use App\Models\Chat;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Penjualan;
use App\Models\PenerimaanBarang;
use App\Models\DataContact;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DateTime;

class AdminUmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.umkm.index');
    }

    public function list(Request $request)
    {
        $data = Company::join('users', 'companies.user_id', '=', 'users.id')->get(['companies.*','users.name AS username']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('name', function ($row) {
                return ($row->name ? $row->name : "-");
            })
            ->editColumn('type', function ($row) {
                return ($row->business_type ? $row->business_type : "-");
            })
            ->editColumn('author', function ($row) {
                return ($row->username ? $row->username : "-");
            })
            ->addColumn('time', function ($row) {
                $time = $row->updated_at;
                $time_ = Carbon::parse($time)->format("d/m/Y");
                return ($time_);
            })
            ->addColumn('status', function ($row) {
                $arrayStatus   = array();
                $dataExpense   = Expense::where('company_id',$row->id)->orderBy('id', 'desc')->first();
                $dataIncome    = Income::where('company_id',$row->id)->orderBy('id', 'desc')->first();
                $dataContact   = DataContact::where('company_id',$row->id)->orderBy('id', 'desc')->first();
                $dataPenjualan = Penjualan::where('company_id',$row->id)->orderBy('id', 'desc')->first();
                $dataPembelian = PenerimaanBarang::where('company_id',$row->id)->orderBy('id', 'desc')->first();

                $dataStatus    = array($dataExpense, $dataIncome, $dataPenjualan, $dataPembelian,$dataContact);
                
                if (($dataExpense === null) && ($dataIncome === null) && ($dataContact === null) && ($dataPenjualan === null) && ($dataPembelian === null))  {
                    $status = '<h5 class="btn bg-gradient-danger btn-small mt-2 disabled">red</h5>';
                }else{
                    foreach ($dataStatus as $statusVar) {
                        if($statusVar !== null) {
                                $time     = $statusVar->created_at;
                                $now      = new DateTime('now');
                                $interval = $now->diff($time);
                                $days     = $interval->format('%a');
                                if($days>=0 && $days<=7) {
                                    $arrayStatus[] = 7; 
                                }
                                else if($days>7 and $days<=30){
                                    $arrayStatus[] = 30;
                                }
                                else{
                                    $arrayStatus[] = 31;
                                }
                            }
                    }
                    $day = (min($arrayStatus));
                    if($day === 7) {
                        $status = '<h5 class="btn bg-gradient-success btn-small mt-2 disabled">green</h5>';
                            }
                    else if($day === 30) {
                        $status = '<h5 class="btn bg-gradient-warning btn-small mt-2 disabled">yellow</h5>';
                            }
                    else if($day === 31) {
                        $status = '<h5 class="btn bg-gradient-danger btn-small mt-2 disabled">red</h5>';
                            }
                }
                return ($status);
            })
            ->addColumn('action', function ($row) {
                $urlInbox = route('admin.umkm.inbox', $row->id);
                $userId  = auth()->user()->id;
                $actionBtn = '
                <a href="' . $urlInbox . '" class="btn bg-gradient-info btn-small mt-2">
                <i class="fa-solid fa-envelope"></i>
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function inbox($id)
    {
        $data = Company::join('users', 'companies.user_id', '=', 'users.id')->get(['companies.*','users.name AS username']);
        $company = $data->find($id);
        $chats_ = Chat::join('companies', 'chats.company_id', '=', 'companies.id')->join('users', 'chats.user_id', '=', 'users.id')->orderBy('id', 'ASC')->get(['chats.*','users.name']);
        $chats = $chats_->where('company_id',$id);
        return view('admin.umkm.inbox',compact('company','chats'));
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

        return redirect()->route('admin.umkm.inbox',$request->company_id);
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
        return redirect()->route('admin.umkm.inbox',$data_id);
    }
     
}
