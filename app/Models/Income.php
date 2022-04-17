<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'incomes';
    protected $guarded = [];

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function toAccount()
    {
        return $this->belongsTo(DataAccount::class);
    }

    public function dataAccounts()
    {
        return $this->belongsToMany(DataAccount::class, 'detail_incomes', 'income_id', 'data_account_id')->withPivot(['id', 'amount'])->withTimestamps();
    }

    public function dataContact()
    {
        return $this->belongsTo(DataContact::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
