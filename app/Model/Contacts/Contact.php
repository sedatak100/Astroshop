<?php

namespace App\Model\Contacts;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $primaryKey = 'contact_id';

    protected $fillable = [
        'firstname', 'lastname', 'email', 'gsm', 'subject', 'message', 'read', 'ip', 'user_agent'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function createdAt()
    {
        return Carbon::parse($this->created_at)->format(config('app.datetime_format'));
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }

    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
