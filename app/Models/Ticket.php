<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tickets';

    protected $fillable = [
        'body','ticket_category_id','status','company_id','user_id','created_at','updated_at'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeCurrentCompany($query)
    {
        return $query->where('company_id', '=', session()->get('company')->id);
    }

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket_responses()
    {
        return $this->hasMany(TicketResponse::class);
    }
}  