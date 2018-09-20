<?php

namespace App\Model\Taxes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaxRule extends Model
{
    protected $primaryKey = 'tax_rule_id';

    protected $fillable = [
        'tax_class_id', 'tax_rate_id', 'based', 'priority'
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

    public function rate()
    {
        return $this->belongsTo('App\Model\Taxes\TaxRate', 'tax_rate_id');
    }
}
