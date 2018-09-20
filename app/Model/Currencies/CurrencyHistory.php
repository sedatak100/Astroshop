<?php

namespace App\Model\Currencies;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    protected $primaryKey = 'currency_history_id';

    protected $fillable = [
        'currency_id', 'code', 'value', 'old_value', 'key', 'description'
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
