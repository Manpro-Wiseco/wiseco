<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsinyasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'konsinyasis';

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // public function dataAccounts()
    // {
    //     return $this->belongsToMany(DataAccount::class, 'detail_expenses', 'expense_id', 'data_account_id')->withPivot(['id', 'amount'])->withTimestamps();
    // }

    public function dataContact()
    {
        return $this->belongsTo(DataContact::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_konsinyasi', 'konsinyasi_id', 'item_id')->withPivot(['id', 'jumlah_barang']);
    }
}
