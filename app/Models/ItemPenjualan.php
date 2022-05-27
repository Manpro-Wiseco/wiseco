<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemPenjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'item_penjualan';

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id' ,'id');
    }

    public function penjualan()
    {
        return $this->belongsTo(PesananPenjualan::class, 'pesanan_penjualan_id', 'id');
    }
}
