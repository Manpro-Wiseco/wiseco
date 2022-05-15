<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'items';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function konsinyasi()
    {
        return $this->belongsToMany(Konsinyasi::class, 'item_konsinyasi', 'item_id', 'konsinyasi_id')->withPivot(['id', 'jumlah_barang', 'harga_barang', 'subtotal']);
    }
}
