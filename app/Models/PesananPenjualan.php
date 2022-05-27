<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PesananPenjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'pesanan_penjualan';

    protected static function booted()
    {
        static::deleted(function($pesanan) {
            $pesanan->penjualan()->delete();
            $pesanan->item()->delete();
        });
    }

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }
    
    public function pelanggan()
    {
        return $this->belongsTo(DataContact::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function item()
    {
        return $this->hasMany(ItemPenjualan::class, 'pesanan_penjualan_id', 'id');
    }

    public function penjualan()
    {
        return $this->hasOne(penjualan::class, 'pesanan_id', 'id');
    }
    
}