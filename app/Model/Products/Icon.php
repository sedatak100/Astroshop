<?php

namespace App\Model\Products;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $primaryKey = 'icon_id';

    protected $fillable = [
        'name', 'description', 'icon', 'image'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at)->format(config('app.datetime_format'));
    }
}
