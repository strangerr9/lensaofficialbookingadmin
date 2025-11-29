<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bookings extends Model
{
    protected $fillable = ['id', 'booking_code', 'bookings_id', 'bride_name', 'bride_phone', 'bride_email', 'groom_name', 'groom_phone',  'groom_email', 'package_id', 'notes', 'same_day', 'status'];

    public function event_bookings()
    {
        return $this->hasMany(Event_bookings::class, 'bookings_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Packages::class, 'package_id');
    }
}
