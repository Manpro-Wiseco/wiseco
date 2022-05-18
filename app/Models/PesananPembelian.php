<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananPembelian extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pesanan_pembelians';

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function dataContact()
    {
        return $this->belongsTo(DataContact::class);
    }

}
