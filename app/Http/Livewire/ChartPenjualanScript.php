<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartPenjualanScript extends Component
{
    public $bulan_tahun;
    protected $listeners = ['ubahBulanTahun_penjualan'];

    public function mount()
    {
        $this->bulan_tahun = date('Y-m');

    }

    public function ubahBulanTahun_penjualan() 
    {

    }

    public function render()
    {
        $bulan = substr($this->bulan_tahun,-2);
        $tahun = substr($this->bulan_tahun,0,4);
        $penjualan = Penjualan::select(DB::raw('count(*) as count, tanggal'))
        ->groupBy('tanggal')
        ->whereMonth('tanggal',$bulan)
        ->whereYear('tanggal',$tahun)
        ->where('status','DITERIMA')
        ->get();

        $hari_per_bulan = Carbon::parse($this->bulan_tahun)->daysInMonth;
        $count = [];
        $tanggal = [];

        for ($i=1; $i <= $hari_per_bulan ; $i++) { 
            for ($j=0; $j < count($penjualan) ; $j++) { 
                if (substr($penjualan[$j]->tanggal,-2)==$i) {
                    $tanggal[$i] = substr($penjualan[$j]->tanggal,-2);
                    $count[$i] = $penjualan[$j]->count;
                    break;
                } else {
                    $tanggal[$i] = $i;
                    $count[$i] = 0;
                }
            }
        }

        // $count = [];
        // foreach ($penjualan as $item) {
        //     $count[] = $item->count;
        // }
        
        // $tanggal = [];
        // foreach ($penjualan as $item) {
        //     $tanggal[] = substr($item->tanggal,-2);
        // }
        
        // var_dump($tanggal);
        // die();
        // dd($tanggal);

        return view('livewire.chart-penjualan-script',compact('count','tanggal'));
    }
}
