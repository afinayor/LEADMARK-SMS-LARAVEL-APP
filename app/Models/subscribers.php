<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;

class subscribers extends Model
{
    //
    public function lists(){
        return $this->belongsTo('leadmark\Models\lists','list_id');
    }
}
