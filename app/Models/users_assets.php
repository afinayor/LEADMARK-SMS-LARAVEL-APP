<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;

class users_assets extends Model
{
    //
    protected $fillable = [
        'user_id',
        'sms_unit',
        'email_unit',
        'landing_page',
    ];
    public $timestamps = false;
}
