<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelian extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'retur_pembelians';

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function dataContact()
    {
        return $this->belongsTo(DataContact::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_retur', 'item_retur_id', 'item_id')->withPivot(['id', 'jumlah_barang', 'harga_barang', 'subtotal']);
    }
}
