<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'penjualan';

    protected static function booted()
    {
        static::deleted(function($pesanan) {
            $pesanan->pengiriman()->delete();
        });
    }

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function pesanan()
    {
        return $this->belongsTo(PesananPenjualan::class, 'pesanan_id', 'id' );
    }

    public function pengiriman()
    {
        return $this->hasOne(PengirimanBarang::class, 'penjualan_id', 'id');
    }

    public function retur()
    {
        return $this->hasOne(ReturPenjualan::class, 'penjualan_id', 'id');
    }

    public function piutang()
    {
        return $this->hasOne(ReturPenjualan::class, 'penjualan_id', 'id');
    }

    
}