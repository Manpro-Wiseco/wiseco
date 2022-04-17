<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundTransfer extends Model
{
    use HasFactory;

    protected $table = 'fund_transfers';
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function fromDataAccounts()
    {
        return $this->belongsTo(DataAccount::class, 'from_bank_account', 'id');
    }

    public function toDataAccounts()
    {
        return $this->belongsTo(DataAccount::class, 'to_bank_account', 'id');
    }
}
