<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'penjualan';

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    
}