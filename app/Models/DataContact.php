<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataContact extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'data_contact';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }
}
