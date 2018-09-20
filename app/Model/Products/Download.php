<?php

namespace App\Model\Products;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $primaryKey = 'download_id';

    protected $fillable = [
        'name', 'description', 'filename', 'based'
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
