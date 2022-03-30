<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'companies';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dataContacts()
    {
        return $this->hasMany(DataContact::class);
    }
}
