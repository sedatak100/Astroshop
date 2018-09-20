<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;

class FilterGroup extends Model
{
    protected $primaryKey = 'filter_group_id';

    protected $fillable = [
        'status', 'name', 'type', 'order'
    ];

    public function id(): int
    {
        return $this->{$this->primaryKey};
    }

    public function countFilter()
    {
        return Filter::where('filter_group_id', $this->id())->count();
    }

    public static function types()
    {
        return [
            'checkbox' => 'CheckBox',
            'radio' => 'Radio',
            'between' => 'Between'
        ];
    }

    public function filters()
    {
        return Filter::where('filter_group_id', $this->id())->get();
    }
}
