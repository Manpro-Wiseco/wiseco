<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketResponse extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'ticket_responses';

    protected $fillable = [
        'response','ticket_id','user_id','created_at','updated_at'
    ];

    // public function company()
    // {
    //     return $this->belongsTo(Company::class);
    // }

    // public function scopeCurrentCompany($query)
    // {
    //     return $query->where('company_id', '=', session()->get('company')->id);
    // }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
