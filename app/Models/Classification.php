<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'classifications';

    public function subclassification()
    {
        return $this->hasMany(Subclassification::class);
    }

    public function dataAccounts()
    {
        return $this->hasManyThrough(DataAccount::class, Subclassification::class);
    }
}
