<?php

namespace App\Model\Taxes;

use App\Model\Products\Product;
use App\Model\Regions\RegionScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    protected $primaryKey = 'tax_class_id';

    protected $fillable = [
        'name', 'description'
    ];

    public static $config_key = 'config.tax_class';

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

    public function isDefault()
    {
        if (config(self::$config_key) == $this->id()) {
            return true;
        }
        return false;
    }

    public function getConfigKey()
    {
        return self::$config_key;
    }

    // todo hata verecek düzelt..
    public function rulesXXX()
    {
        return TaxRule::where('tax_class_id', $this->id())->get();
    }

    public function rules()
    {
        return $this->hasMany('App\Model\Taxes\TaxRule', 'tax_class_id');
    }

    public static function setRates($tax_class_id)
    {
        $key = 'tax.' . $tax_class_id;
        if (!config($key)) {
            config()->set($key, self::with(['rules' => function ($query) {
                $query->with('rate')->orderBy('priority', 'ASC');
            }])->first());
        }
    }

    public static function calc($value, $tax_class_id, $calc = 'config')
    {
        $amount = $value;

        if ($calc === 'config') {
            $calc = config('config.tax_show') ? true : false;
        }

        if ($calc && $tax_class_id) {
            self::setRates($tax_class_id);

            $tax_class = config('tax.' . $tax_class_id);
            if ($tax_class && $tax_class->rules) {
                foreach ($tax_class->rules as $tax_rules) {
                    if ($tax_rules->rate) {
                        $tax_rate = $tax_rules->rate;
                        if ($tax_rate->type == 'percent') {
                            $amount += ($value / 100 * $tax_rate->rate);
                        } elseif ($tax_rate->type == 'amount') {
                            $amount += $tax_rate->rate;
                        }
                    }
                }
            }
        }
        return $amount;
    }

    public static function onlyCalc($value, $tax_class_id, $calc = 'config')
    {
        $amount = $value;

        if ($calc === 'config') {
            $calc = config('config.tax_show') ? true : false;
        }

        if ($calc && $tax_class_id) {
            self::setRates($tax_class_id);

            $tax_class = config('tax.' . $tax_class_id);
            if ($tax_class && $tax_class->rules) {
                foreach ($tax_class->rules as $tax_rules) {
                    if ($tax_rules->rate) {
                        $tax_rate = $tax_rules->rate;
                        if ($tax_rate->type == 'percent') {
                            $amount += ($value / 100 * $tax_rate->rate);
                        } elseif ($tax_rate->type == 'amount') {
                            $amount += $tax_rate->rate;
                        }
                    }
                }
            }
        }
        return $amount - $value;
    }
}
