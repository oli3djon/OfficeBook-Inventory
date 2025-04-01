<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Пользователи, которые принадлежат данной роли.
     */    
    
    
    protected $fillable = [
        'name'
    ];

    
    public function users() {
		return $this->belongsToMany('App\User','role_user','role_id','user_id'); // role_user
	}
    
    
}
