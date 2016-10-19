<?php namespace leadmark\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract{

    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'phone',
        'password',
        'first_name',
        'last_name',
        'birthday',
        'profile_pic',
        'title',
        'address',
        'website',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'google_plus'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function contacts()
    {
        return $this->hasMany('leadmark\Models\Contacts');
    }

    public function contact_groups()
    {
        return $this->hasMany('leadmark\Models\contact_groups') ;
    }




    public function getUsername(){
        if($this->username) {
            return $this->username;
        }else{
            return null;
        }
    }
    public function getName(){
        if($this->first_name && $this->last_name){
            return $this->first_name." ".$this->last_name;
        }
        if($this->first_name){
            return $this->first_name;
        }
        if(!$this->first_name && !$this->last_name){
            return $this->username;
        }
    }

}
