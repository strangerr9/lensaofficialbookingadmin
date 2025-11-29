<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_bookings extends Model
{
    protected $fillable = ['id', 'event_code', 'bookings_id' , 'event_type', 'event_date', 'venue_type', 'venue_address'];

    public function booking()
    {
        return $this->belongsTo(Bookings::class);
    }
}
