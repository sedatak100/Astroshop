<?php

namespace App\Model\Tickets;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $primaryKey = 'ticket_id';

    protected $fillable = [
        'customer_id', 'order_id', 'firstname', 'lastname', 'email', 'gsm', 'subject', 'message',
        'reply', 'close', 'ip', 'user_agent'
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

    public function replies()
    {
        return $this->hasMany('App\Model\Tickets\TicketReply', 'ticket_id', 'ticket_id')
            ->orderBy('created_at', 'ASC');
    }
}
