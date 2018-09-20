<?php

namespace App\Model\Users;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $primaryKey = 'user_group_id';

    protected $fillable = [
        'user_group_id', 'name', 'permission'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function permissions(): array
    {
        $permission = @json_decode($this->permission, true);
        if (!json_last_error()) {
            return $permission;
        }
        return [];
    }
}
