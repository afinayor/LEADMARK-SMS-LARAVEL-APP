<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;

class lists extends Model
{
    //
    public function subscribers(){
        return $this->hasMany('leadmark\Models\subscribers','list_id');
    }
}
