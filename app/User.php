<?php

namespace App;

use App\Models\Attendance;
use App\Models\File;
use App\Models\Log;
use App\Models\Organizacao;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'users_files');
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        $result = false;

        if(is_array($roles) || is_object($roles)){
            foreach($roles as $role)
            {
                if($this->roles->contains('title', $role->title)) {
                    $result = true;
                };
            }
        }

        return $result;
    }
}
