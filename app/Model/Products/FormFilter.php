<?php

namespace App\Model\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormFilter extends Model
{
    public static function formFilter($query, Request $request)
    {
        // Filter
        if ($request->has('f')) {
            $name = $request->input('f.name');
            $brand = $request->input('f.brand');
            $attr_select = $request->input('f.attr_select');
            $attr_between = $request->input('f.attr_between');

            if ($name != '') {
                $query->where(function ($q) use ($name) {
                    $q->where('name', 'LIKE', '%' . $name . '%');
                    $q->orWhereHas('tags', function ($q) use ($name) {
                        $q->where('name', 'LIKE', '%' . $name . '%');
                    });
                });
            }

            if ($brand != '') {
                $db_brand = Brand::where([
                    'status' => 1,
                    'seo_name' => $brand
                ])->first();
                if ($db_brand) {
                    $query->where('brand_id', $db_brand->id());
                }
            }

            if (is_array($attr_select)) {
                foreach ($attr_select as $attribute_id => $value) {
                    if ($value != '') {
                        $query->whereHas('attributes', function ($q) use ($attribute_id, $value) {
                            $q->where('product_attributes.attribute_id', $attribute_id);
                            $q->where('value', $value);
                        });
                    }
                }
            }

            if (is_array($attr_between)) {
                foreach ($attr_between as $attribute_id => $value) {
                    $start = $request->input('f.attr_between.' . $attribute_id . '.1');
                    $end = $request->input('f.attr_between.' . $attribute_id . '.2');
                    if ($start != '' && $end != '') {
                        $start = floatval($start);
                        $end = floatval($end);
                        $query->whereHas('attributes', function ($q) use ($attribute_id, $start, $end) {
                            $q->where('product_attributes.attribute_id', $attribute_id);
                            $q->whereBetween('value', [$start, $end]);
                        });
                    }
                }
            }
        }
        return $query;
    }
}
