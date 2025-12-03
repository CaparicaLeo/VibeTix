<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Inscription extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_id',
        'event_id',
        'ticket_id',
        'status',
        'qr_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
