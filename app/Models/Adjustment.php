<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'adjustments';

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_adjustment', 'adjustment_id', 'item_id')->withPivot(['id', 'jumlah_barang', 'harga_barang', 'subtotal'])->withTimestamps();
    }
}
