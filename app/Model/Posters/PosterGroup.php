<?php

namespace App\Model\Posters;

use Illuminate\Database\Eloquent\Model;

class PosterGroup extends Model
{
    protected $primaryKey = 'poster_group_id';

    protected $fillable = [
        'name', 'description', 'status'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function countPoster()
    {
        return Poster::where('poster_group_id', $this->id())->count();
    }

    public function posters()
    {
        return $this->hasMany('App\Model\Posters\Poster', 'poster_group_id')->orderBy('order', 'ASC');
    }
}
