<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subclassification extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'subclassifications';


    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', null)->orWhere('company_id', '=', session()->get('company')->id);
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }

    public function dataAccount()
    {
        return $this->hasMany(DataAccount::class);
    }
}
