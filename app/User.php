<?php

namespace App;

use App\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'oidc_id', 'name', 'surname', 'email', 'password','organization'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'oidc_id', 'email','password', 'remember_token', 'trace'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullnameAttribute(){
        return $this->surname . ', ' . $this->name;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role','role_user','user_id','role_id')->withTimestamps();
    }

    public function objectives($hidden = null)
    {
        $q = $this->belongsToMany('App\Objective','objective_user','user_id','objective_id')->withPivot('role')->withTimestamps();
        if(!is_null($hidden)){
            $q = $q->where('hidden',$hidden);
        }
        return $q;

    }

    public function subscriptions($hidden = null)
    {
        $q = $this->belongsToMany('App\Objective','objective_subscriber','subscriber_id','objective_id')->withTimestamps();
        if(!is_null($hidden)){
            $q = $q->where('hidden',$hidden);
        }
        return $q;
    }
    
    public function avatar()
    {
        return $this->morphOne('App\ImageFile', 'imageable');
    }
    
    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);    
        return true;
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true; 
            }   
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function isMemberObjective($objectiveId)
    {
        return $this->objectives()->where('objectives.id', $objectiveId)->exists();
    }

    public function isManagerObjective($objectiveId)
    {
        return $this->objectives()->where('objectives.id', $objectiveId)->wherePivot('role','manager')->exists();
    }

    public function isReporterObjective($objectiveId)
    {
        return $this->objectives()->where('objectives.id', $objectiveId)->wherePivot('role','reporter')->exists();
    }

    public function isOidcUser()
    {
        return !is_null($this->oidc_id);
    }
}
