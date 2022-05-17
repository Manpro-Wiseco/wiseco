<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranHarga extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'penawaran_harga';

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
}
