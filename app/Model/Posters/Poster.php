<?php

namespace App\Model\Posters;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $primaryKey = 'poster_id';

    protected $fillable = [
        'poster_group_id', 'name', 'description', 'link', 'target', 'config', 'config2', 'image', 'image2', 'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public static function targets(): array
    {
        return [
            '_blank',
            '_parent',
            '_self',
            '_top'
        ];
    }
}
