<?php

namespace App\Model\Users;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_group_id', 'status', 'firstname', 'lastname', 'email', 'password', 'last_login_ip', 'last_login_date'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function id()
    {
        return $this->user_id;
    }

    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function createdAt()
    {
        return Carbon::parse($this->created_at)->format(config('app.datetime_format'));
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function lastLoginDate()
    {
        return Carbon::parse($this->last_login_date)->format(config('app.datetime_format'));
    }

    public function userGroup()
    {
        return UserGroup::findOrFail($this->user_group_id);
    }

    public function isPerm($route): bool
    {
        $except = [
            'backend.logout',
            'backend.home.index'
        ];
        $permissions = array_merge($this->userGroup()->permissions(), $except);
        if (in_array($route, $permissions) !== false) {
            return true;
        }
        return false;
    }
}
