<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturPenjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'retur_penjualan';

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(DataContact::class, 'pelanggan_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}