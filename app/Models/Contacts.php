<?php

namespace leadmark\Models;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('leadmark\Models\User');
    }

    public function contact_groups(){
        return $this->belongsTo('leadmark\Models\Contact_groups','contact_groups_id');
    }

}
