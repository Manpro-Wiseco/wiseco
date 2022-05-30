<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryBayarPiutang extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $table = 'history_pembayaran_piutang';

    public function bank()
    {
        return $this->belongsTo(DataBank::class, 'data_bank_id', 'id' );
    }
}
