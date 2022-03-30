<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'bank_accounts';

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function subclassification()
    {
        return $this->belongsTo(Subclassification::class);
    }

    public function dataBank()
    {
        return $this->belongsTo(DataBank::class);
    }

    public function expenses()
    {
        return $this->belongsToMany(Expense::class, 'detail_expenses', 'bank_account_id', 'expense_id')->withPivot(['id', 'amount'])->withTimestamps();
    }
}
