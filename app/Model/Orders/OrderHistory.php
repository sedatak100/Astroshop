<?php

namespace App\Model\Orders;

use App\Events\OrderHistoryCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $primaryKey = 'order_history_id';

    protected $fillable = [
        'order_id',
        'order_status_id',
        'order_status',
        'note'
    ];

    protected $dispatchesEvents = [
        'created' => OrderHistoryCreated::class
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
}
