<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    //

    public function autoschedules(){
        return $this->hasMany('leadmark\Models\autoscheduler','message_id');
    }
}
