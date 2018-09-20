<?php

namespace App\Http\Controllers\Backend\Products;

use App\Events\ProductAddedEdited;
use App\Http\Controllers\BackendController;
use App\Model\Currencies\Currency;
use App\Model\Customers\CustomerGroup;
use App\Model\Products\Product;
use App\Model\Products\ProductAttribute;
use App\Model\Products\ProductCampaign;
use App\Model\Products\ProductCategory;
use App\Model\Products\ProductDiscount;
use App\Model\Products\ProductDownload;
use App\Model\Products\ProductFilter;
use App\Model\Products\ProductSimilar;
use App\Model\Products\ProductTag;
use App\Model\Products\ProductIcon;
use App\Model\Products\ProductImage;
use App\Model\Statuses\StockStatus;
use App\Model\Taxes\TaxClass;
use App\Model\Units\Length;
use App\Model\Units\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends BackendController
{
    public function lists(Request $request)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Ürünler', 'link' => '']
        ]);

        $blade = [];
        $products = Product::orderBy('order', 'ASC');
        $products = $this->formFilter($products, $request)->paginate(config('default.paginate'));
        $blade['products'] = $products;
        return view('backend.products.product_lists', $blade);
    }

    private function formFilter($query, Request $request)
    {
        if ($request->input('f.name') != null) {
            $query->where('name', 'like', '%' . $request->input('f.name') . '%');
        }

        if ($request->input('f.model') != null) {
            $query->where('model', $request->input('f.model'));
        }

        if ($request->input('f.stock_code') != null) {
            $query->where('stock_code', $request->input('f.stock_code'));
        }

        if ($request->input('f.status') != null) {
            $query->where('status', $request->input('f.status'));
        }

        if ($request->input('f.brand_id') != null) {
            $query->whereIn('brand_id', $request->input('f.brand_id') ?? []);
        }

        if ($request->input('f.category_id') != null) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('product_categories.category_id', $request->input('f.category_id') ?? []);
            });
        }

        return $query;
    }

    private function addEditViewData()
    {
        $blade = [];
        $tax_classes = TaxClass::all();
        $blade['tax_classes'] = $tax_classes;

        $weights = Weight::all();
        $blade['weights'] = $weights;

        $lengths = Length::all();
        $blade['lengths'] = $lengths;

        $stock_statuses = StockStatus::all();
        $blade['stock_statuses'] = $stock_statuses;

        $customer_groups = CustomerGroup::all();
        $blade['customer_groups'] = $customer_groups;

        $currencies = Currency::all();
        $blade['currencies'] = $currencies;

        return $blade;
    }

    private function addEditFormData($id, Request $request)
    {
        $this->formValidate($request);

        $save = [
            // TAB 1
            'name' => $request->post('name'),
            'short_description' => $request->post('short_description'),
            'description' => $request->post('description'),
            'order' => $request->post('order'),
            'status' => $request->post('status'),
            // TAB 2
            'seo_name' => $request->post('seo_name'),
            'meta_title' => $request->post('meta_title'),
            'meta_keyword' => $request->post('meta_keyword'),
            'meta_description' => $request->post('meta_description'),
            // TAB 3
            'model' => $request->post('model'),
            'stock_code' => $request->post('stock_code'),
            'barcode' => $request->post('barcode'),
            'serial_no' => $request->post('serial_no'),
            'serial_no2' => $request->post('serial_no2'),
            'serial_no3' => $request->post('serial_no3'),
            'price' => $request->post('price'),
            'currency_id' => $request->post('currency_id'),
            'quantity' => $request->post('quantity'),
            'min_quantity' => $request->post('min_quantity'),
            'subtract' => $request->post('subtract'),
            'stock_status_id' => $request->post('stock_status_id'),
            'shipping' => $request->post('shipping'),
            'tax_class_id' => $request->post('tax_class_id'),
            'date_available' => $request->post('date_available'),
            'length' => $request->post('length'),
            'width' => $request->post('width'),
            'height' => $request->post('height'),
            'length_id' => $request->post('length_id'),
            'weight' => $request->post('weight'),
            'weight_id' => $request->post('weight_id'),
            // TAB 4
            'brand_id' => $request->post('brand_id'),
            // TAB 8
            'image' => $request->post('main_image')
        ];

        if ($id > 0) {
            Product::where('product_id', $id)->update($save);
            $product = Product::find($id);

            ProductCategory::where('product_id', $product->id())->delete();
            ProductDownload::where('product_id', $product->id())->delete();
            ProductIcon::where('product_id', $product->id())->delete();
            ProductFilter::where('product_id', $product->id())->delete();
            ProductSimilar::where('product_id', $product->id())->delete();
            ProductAttribute::where('product_id', $product->id())->delete();
            ProductTag::where('product_id', $product->id())->delete();
            ProductDiscount::where('product_id', $product->id())->delete();
            ProductCampaign::where('product_id', $product->id())->delete();
            ProductImage::where('product_id', $product->id())->delete();

        } else {
            $product = Product::create($save);
        }
        // TAB 4
        // Categories
        if ($request->has('category_id')) {
            foreach ($request->post('category_id') as $category_id) {
                ProductCategory::create([
                    'product_id' => $product->id(),
                    'category_id' => $category_id
                ]);
            }
        }
        // Downloads
        if ($request->has('download_id')) {
            foreach ($request->post('download_id') as $download_id) {
                ProductDownload::create([
                    'product_id' => $product->id(),
                    'download_id' => $download_id
                ]);
            }
        }
        // Icons
        if ($request->has('icon_id')) {
            foreach ($request->post('icon_id') as $icon_id) {
                ProductIcon::create([
                    'product_id' => $product->id(),
                    'icon_id' => $icon_id
                ]);
            }
        }
        // Filters
        if ($request->has('filter_id')) {
            foreach ($request->post('filter_id') as $filter_id) {
                ProductFilter::create([
                    'product_id' => $product->id(),
                    'filter_id' => $filter_id
                ]);
            }
        }
        // Filters
        if ($request->has('similar_id')) {
            foreach ($request->post('similar_id') as $similar_id) {
                ProductSimilar::create([
                    'product_id' => $product->id(),
                    'similar_id' => $similar_id
                ]);
            }
        }
        // TAB 5
        // Attributes
        if ($request->has('attribute')) {
            foreach ($request->post('attribute') as $i => $attribute) {
                if (!$request->input('attribute.' . $i . '.value')) {
                    continue;
                }

                ProductAttribute::create([
                    'product_id' => $product->id(),
                    'attribute_id' => $attribute['attribute_id'],
                    'value' => $attribute['value']
                ]);
            }
        }

        if ($request->has('tag')) {
            $tags = explode(',', $request->post('tag'));
            foreach ($tags as $tag) {
                if ($tag != '') {
                    ProductTag::create([
                        'product_id' => $product->id(),
                        'name' => trim($tag)
                    ]);
                }
            }
        }

        // TAB 6
        // Discounts
        if ($request->has('discount')) {
            foreach ($request->post('discount') as $i => $discount) {
                if (!$request->input('discount.' . $i . '.price')) {
                    continue;
                }
                ProductDiscount::create([
                    'product_id' => $product->id(),
                    'customer_group_id' => $discount['customer_group_id'],
                    'price' => $discount['price'],
                    'quantity' => $discount['quantity'],
                    'start_date' => $discount['start_date'],
                    'end_date' => $discount['end_date'],
                    'priority' => $discount['priority']
                ]);
            }
        }
        // TAB 7
        // Campaigns
        if ($request->has('campaign')) {
            foreach ($request->post('campaign') as $i => $campaign) {
                if (!$request->input('campaign.' . $i . '.price')) {
                    continue;
                }

                ProductCampaign::create([
                    'product_id' => $product->id(),
                    'customer_group_id' => $campaign['customer_group_id'],
                    'price' => $campaign['price'],
                    'start_date' => $campaign['start_date'],
                    'end_date' => $campaign['end_date'],
                    'priority' => $campaign['priority']
                ]);
            }
        }
        // TAB 8
        // Images
        if ($request->has('image')) {
            foreach ($request->post('image') as $i => $image) {
                if (!$request->input('image.' . $i . '.path')) {
                    continue;
                }
                ProductImage::create([
                    'product_id' => $product->id(),
                    'image' => $image['path'],
                    'order' => $image['order']
                ]);
            }
        }

        event(new ProductAddedEdited($product));
    }

    public function add()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Ürünler', 'link' => route('backend.product.lists')],
            ['name' => 'Ekle', 'link' => '']
        ]);

        $blade = $this->addEditViewData();
        return view('backend.products.product_add', $blade);
    }

    private function formValidate(Request $request)
    {
        $request->validate([
            // TAB 1
            'name' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
            // TAB 2
            'seo_name' => 'required',
            // TAB 3
            'price' => 'required|numeric',
            'currency_id' => 'required|integer',
            'quantity' => 'required|numeric',
            'min_quantity' => 'required|numeric',
            'subtract' => 'required|numeric',
            'stock_status_id' => 'required|integer',
            'shipping' => 'required|numeric',
            'tax_class_id' => 'required|integer',
            'date_available' => 'nullable|date',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'length_id' => 'required|integer',
            'weight' => 'required|numeric',
            'weight_id' => 'required|integer',
            // TAB 4
            'brand_id' => 'required|integer',
            'category_id' => 'array',
            'download_id' => 'array',
            'icon_id' => 'array',
            'filter_id' => 'array',
            'similar_id' => 'array'
        ]);

        // TAB 5
        if ($request->has('attribute')) {
            foreach ($request->post('attribute') as $i => $attribute) {
                if (isset($attribute['attribute_id']) && ($attribute['attribute_id'] != '0' || $attribute['value'] != '')) {
                    $request->validate([
                        'attribute.' . $i . '.attribute_id' => 'required|integer|min:1',
                        'attribute.' . $i . '.value' => 'required',
                    ]);
                }
            }
        }

        // TAB 6
        if ($request->has('discount')) {
            foreach ($request->post('discount') as $i => $discount) {
                if ($discount['quantity'] != '' || $discount['priority'] != '' || $discount['price']) {
                    $request->validate([
                        'discount.' . $i . '.customer_group_id' => 'required|integer|min:1',
                        'discount.' . $i . '.quantity' => 'required|integer|min:2',
                        'discount.' . $i . '.priority' => 'required|numeric',
                        'discount.' . $i . '.price' => 'required|numeric',
                        'discount.' . $i . '.start_date' => 'nullable|date',
                        'discount.' . $i . '.end_date' => 'nullable|date',
                    ]);
                }
            }
        }

        // TAB 7
        if ($request->has('campaign')) {
            foreach ($request->post('campaign') as $i => $campaign) {
                if ($campaign['priority'] != '' || $campaign['price']) {
                    $request->validate([
                        'campaign.' . $i . '.customer_group_id' => 'required|integer|min:1',
                        'campaign.' . $i . '.priority' => 'required|numeric',
                        'campaign.' . $i . '.price' => 'required|numeric',
                        'campaign.' . $i . '.start_date' => 'nullable|date',
                        'campaign.' . $i . '.end_date' => 'nullable|date',
                    ]);
                }
            }
        }

        // TAB 8
        if ($request->has('image')) {
            foreach ($request->post('image') as $i => $image) {
                if ($image['path'] != '') {
                    $request->validate([
                        'image.' . $i . '.order' => 'required|numeric'
                    ]);
                }
            }
        }
    }

    public function added(Request $request)
    {
        $request->validate([
            // TAB 2
            'seo_name' => 'unique:products,seo_name',
        ]);

        $this->addEditFormData(0, $request);

        return redirect()->route('backend.product.lists')
            ->with('success', 'Ürün Eklendi');
    }

    public function edit($id)
    {
        view()->share('breadcrumbs', [
            ['name' => 'Ürünler', 'link' => route('backend.product.lists')],
            ['name' => 'Düzenle', 'link' => '']
        ]);

        $blade = $this->addEditViewData();
        $product = Product::with(['similars'])->findOrFail($id);

        if ($product->similars->count() > 0) {
            $product->similars->map(function ($product) {
                return $product['product_id'] = $product->similar_id;
            });
        }
        $blade['product'] = $product;

        return view('backend.products.product_edit', $blade);
    }

    public function edited($id, Request $request)
    {
        $request->validate([
            // TAB 2
            'seo_name' => 'unique:products,seo_name,' . $id . ',product_id',
        ]);

        $this->addEditFormData($id, $request);


        return redirect()->route('backend.product.lists')
            ->with('success', 'Ürün Düzenlendi');
    }

    public function remove($id)
    {
        Product::destroy($id);
        ProductCategory::where('product_id', $id)->delete();
        ProductDownload::where('product_id', $id)->delete();
        ProductIcon::where('product_id', $id)->delete();
        ProductFilter::where('product_id', $id)->delete();
        ProductSimilar::where('product_id', $id)->delete();
        ProductAttribute::where('product_id', $id)->delete();
        ProductDiscount::where('product_id', $id)->delete();
        ProductCampaign::where('product_id', $id)->delete();
        ProductImage::where('product_id', $id)->delete();
        return redirect()->route('backend.product.lists')
            ->with('success', 'Ürün Silindi');
    }
}
