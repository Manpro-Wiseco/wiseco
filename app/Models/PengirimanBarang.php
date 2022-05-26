<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBarang extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pengiriman_barang';

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'id');
    }

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }
}