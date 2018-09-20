<?php

namespace App\Model\Taxes;

use App\Model\Regions\Region;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    protected $primaryKey = 'tax_rate_id';

    protected $fillable = [
        'region_id', 'name', 'rate', 'type'
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

    public function region()
    {
        return Region::find($this->region_id);
    }

    public function customerGroups($columns = ['*'])
    {
        return TaxRateCustomerGroup::where('tax_rate_id', $this->id())->get($columns);
    }
}
