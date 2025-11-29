<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class packages extends Model
{
    protected $fillable = [
        'id','name', 'short_code', 'events_included', 'price', 'description' , 'visibility','archived'
    ];

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

}
