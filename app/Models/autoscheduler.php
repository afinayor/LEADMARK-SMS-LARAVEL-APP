<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;

class autoscheduler extends Model
{
    //

    public function auto_birthday(){
        return $this->hasOne('leadmark\Models\auto_birthday','autoschedule_id');
    }
    public function message(){

        return $this->belongsTo('leadmark\Models\messages','message_id');
    }
    public function auto_frequency(){
        return $this->hasOne('leadmark\Models\auto_frequency','autoschedule_id');
    }
    public function auto_date(){
        return $this->hasOne('leadmark\Models\auto_date','autoschedule_id');
    }
}
