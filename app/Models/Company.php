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

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
