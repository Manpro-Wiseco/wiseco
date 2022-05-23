<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananPenjualan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'pesanan_penjualan';

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
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id', 'id');
    }
    
}