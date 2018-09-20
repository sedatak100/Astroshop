<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormOrder extends Model
{
    public static function order($query, Request $request)
    {
        //todo: price göre sıralama currency göre düzenlenecek.
        if ($request->has('o')) {
            $price = $request->input('o.price');
            if ($price == 'ASC') {
                $query->join('currencies', 'currencies.currency_id', '=', 'products.currency_id')
                    ->orderBy(DB::raw('products.price * currencies.value'), 'ASC');
            } elseif ($price == 'DESC') {
                $query->join('currencies', 'currencies.currency_id', '=', 'products.currency_id')
                    ->orderBy(DB::raw('products.price * currencies.value'), 'DESC');
            }
        }
        return $query;
    }
}
