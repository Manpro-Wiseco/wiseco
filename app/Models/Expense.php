<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'expenses';

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function bankAccounts()
    {
        return $this->belongsToMany(BankAccount::class, 'detail_expenses', 'expense_id', 'bank_account_id')->withPivot(['id', 'amount'])->withTimestamps();
    }

    public function fromAccount()
    {
        return $this->belongsTo(DataAccount::class);
    }

    public function dataAccounts()
    {
        return $this->belongsToMany(DataAccount::class, 'detail_expenses', 'expense_id', 'data_account_id')->withPivot(['id', 'amount'])->withTimestamps();
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
