<?php

namespace App\Model\Tickets;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $primaryKey = 'ticket_reply_id';

    protected $fillable = [
        'ticket_id', 'customer_id', 'user_id', 'firstname', 'lastname', 'message',
        'ip', 'user_agent'
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
