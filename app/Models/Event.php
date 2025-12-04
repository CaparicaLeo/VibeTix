<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Event extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'description',
        'date_time',
        'location',
        'banner_image_url',
        'status',
        'organizer_id'
    ];

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    public function organizer(){
        return $this->belongsTo(User::class, 'organizer_id');
    }
}
