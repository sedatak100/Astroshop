<?php

namespace App\Model\Currencies;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $primaryKey = 'currency_id';

    protected $fillable = [
        'currency_id', 'name', 'code', 'symbol_left', 'symbol_right', 'decimal_place', 'value'
    ];

    public static $config_key = 'config.currency';

    public function id(): int
    {
        return $this->{$this->primaryKey};
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

    public static function format($number, $id = 0, $value = '', $format = true, $orjinal_format = true)
    {
        if ($id == 0) {
            $id = config('config.currency');
        }

        $currency = config('currencies')->find($id);

        if ($value == '') {
            $value = $currency->value;
        }

        $amount = $value ? $number * $value : $number;
        $amount = round($amount, $currency->decimal_place);

        if (!$format) {
            return $amount;
        }

        if ($orjinal_format) {
            $currency = config('currencies')->find(config('config.currency'));
        }
        $string = '';

        if ($currency->symbol_left) {
            $string .= $currency->symbol_left;
        }
        // todo: dec_point ve thousands_sep configden çekilecek
        $string .= number_format($amount, $currency->decimal_place, '.', ',');

        if ($currency->symbol_right) {
            $string .= $currency->symbol_right;
        }
        return $string;
    }

    public function histories()
    {
        return $this->hasMany('App\Model\Currencies\CurrencyHistory', 'currency_id');
    }
}
