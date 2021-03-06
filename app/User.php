<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use App\Page;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pages()
    {
        return $this->hasMany('App\Page');
    }

    public function collections()
    {
        return $this->hasMany('App\Collection');
    }

    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function inboxes()
    {
        return $this->hasMany('App\Inbox');
    }

    public function groupsMember(){
        return $this->hasMany('App\UserGroup');
    }

    public function sharesGroups(){
        return $this->hasMany('App\ShareGroup');
    }

    public function authGroupShares(){
        return $this->hasMany('App\ShareGroupPolicies');
    }

    public function shareDirectories(){
        return $this->hasMany('App\ShareDirectory');
    }

    public function friends()
    {
        return $this->hasMany('App\Friend');
    }

    public function roles()
    {
        return $this->hasMany('App\RoleUser','user_id');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');

    }

}
