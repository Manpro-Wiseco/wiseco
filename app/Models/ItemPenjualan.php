<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'item_penjualan';

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id' ,'id');
    }

    public function penjualan()
    {
        return $this->belongsTo(PesananPenjualan::class, 'penjualan_id', 'id');
    }
}
