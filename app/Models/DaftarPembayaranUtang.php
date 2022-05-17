<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPembayaranUtang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'daftar_pembayaran_utangs';
}
