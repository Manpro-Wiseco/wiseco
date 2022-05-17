<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'ticket_categories';
    protected $fillable = [
        'category','created_at','updated_at'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
