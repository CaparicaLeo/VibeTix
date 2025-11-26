<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'price',
        'quantity_total',
        'event_id'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
