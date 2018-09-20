<?php

namespace App\Http\Controllers\Frontend\Home;

use App\Http\Controllers\Backend\ShippingMethods\FreeController;
use App\Model\Products\Attribute;
use App\Model\Products\Brand;
use App\Model\Products\Category;
use App\Model\Products\Product;
use App\Model\Products\ProductAttribute;
use App\Model\Products\ProductCampaign;
use App\Model\Products\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MaintenanceController extends FreeController
{
    public function open()
    {
        session()->put('maintenance', true);
        return redirect('home.index');
    }

    private function kategoriNameToIds($name)
    {
        $id = 0;
        if ($name == 'ELEKTRONİK KUNDAKLI TELESKOPLAR') {
            $id = 7;
        } elseif ($name == 'MANUEL KUNDAKLI TELESKOPLAR') {
            $id = 8;
        } elseif ($name == 'Güneş Teleskopları') {
            $id = 2;
        } elseif ($name == 'Dürbünler') {
            $id = 3;
        } elseif ($name == 'Göz Mercekleri') {
            $id = 9;
        } elseif ($name == 'Güneş Filtreleri') {
            $id = 10;
        } elseif ($name == 'IŞIK MİKROSKOPLARI') {
            $id = 11;
        } elseif ($name == 'STEREO MİKROSKOPLAR') {
            $id = 12;
        } elseif ($name == 'DİJİTAL MİKROSKOPLAR') {
            $id = 13;
        }
        return $id;
    }

    private function brandCreated($name)
    {
        $brand = Brand::where('name', $name)->first();
        if (!$brand) {
            $new_brand = Brand::create([
                'status' => 1,
                'name' => trim($name),
                'seo_name' => str_slug(trim($name)),
            ]);
            return $new_brand->id();
        } else {
            return $brand->id();
        }
    }

    public function view(Request $request)
    {



        if ($request->input('sheet') == 1) {

            $inputFileName = getcwd() . '/excel.xlsx';

            /** Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $spreadsheet->setActiveSheetIndex(0);
            $sheetDatas = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);

            //  unset($sheetDatas[0]);
            //  unset($sheetDatas[1]);
            foreach ($sheetDatas as $i => $sheetData) {
                if ($i <= 1) {
                    continue;
                }

                $product_data = [];
                $product_data['status'] = 1;
                $product_data['barcode'] = $sheetData[2];
                $product_data['name'] = $sheetData[3];
                $product_data['seo_name'] = str_slug($sheetData[3]);
                $product_data['brand_id'] = $this->brandCreated($sheetData[4]);
                $product_data['serial_no2'] = $sheetData[5];
                $product_data['serial_no'] = $sheetData[6];
                $product_data['model'] = $sheetData[7];
                $product_data['short_description'] = $sheetData[34];
                $product_data['description'] = $sheetData[35];
                $product_data['stock_status_id'] = 1; // Stokda Var
                $product_data['min_quantity'] = 1;
                $product_data['quantity'] = $sheetData[44];

                $kampanya = [];
                if ($sheetData[42] != '') {
                    $product_data['price'] = $sheetData[42];

                    $kampanya['customer_group_id'] = 1; // Default yap
                    $kampanya['price'] = $sheetData[40];
                    $kampanya['priority'] = 0;

                } else {
                    $product_data['price'] = $sheetData[40] != '' ? $sheetData[40] : 0;
                }


                // Para Birimi
                if ($sheetData[39] == 'EUR') {
                    $currency_id = 3;
                } elseif ($sheetData[39] == 'USD') {
                    $currency_id = 1;
                } else {
                    $currency_id = 2;
                }
                $product_data['currency_id'] = $currency_id;

                $product = Product::create($product_data);
                if ($kampanya) {
                    $kampanya['product_id'] = $product->id();
                    ProductCampaign::create($kampanya);
                }

                $kategori_id = $this->kategoriNameToIds($sheetData[1]);
                if ($kategori_id > 0) {
                    ProductCategory::create([
                        'product_id' => $product->id(),
                        'category_id' => $kategori_id
                    ]);
                } else {
                    die('KATEGORI BULUNAMADI : ' . $sheetData[1]);
                }

                // Özellikler
                for ($x = 8; $x <= 33; $x++) {
                    $attribute = Attribute::where('name', $sheetDatas[1][$x])->first();
                    if ($attribute) {
                        if ($sheetData[$x] != '') {
                            ProductAttribute::create([
                                'product_id' => $product->id(),
                                'attribute_id' => $attribute->id(),
                                'value' => $sheetData[$x]
                            ]);
                        }
                    } else {
                        die('ÖZELLİK BULUNAMADI' . $sheetDatas[1][$x]);
                    }
                }

            }
        } elseif ($request->input('sheet') == 2) {
            $inputFileName = getcwd() . '/excel.xlsx';

            /** Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $spreadsheet->setActiveSheetIndex(1);
            $sheetDatas = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);

            //  unset($sheetDatas[0]);
            unset($sheetDatas[8]);
            foreach ($sheetDatas as $i => $sheetData) {


                if ($i <= 1) {
                    continue;
                }

                $product_data = [];
                $product_data['status'] = 1;
                $product_data['barcode'] = $sheetData[2];
                $product_data['name'] = $sheetData[3];
                $product_data['seo_name'] = str_slug($sheetData[3]);
                $product_data['brand_id'] = $this->brandCreated($sheetData[4]);
                $product_data['serial_no2'] = $sheetData[5];
                $product_data['serial_no'] = $sheetData[6];
                $product_data['model'] = $sheetData[7];
                $product_data['short_description'] = $sheetData[39];
                $product_data['description'] = $sheetData[38];
                $product_data['stock_status_id'] = 1; // Stokda Var
                $product_data['min_quantity'] = 1;
                $product_data['quantity'] = $sheetData[47];

                $kampanya = [];
                if ($sheetData[45] != '') {
                    $product_data['price'] = $sheetData[45];

                    $kampanya['customer_group_id'] = 1; // Default yap
                    $kampanya['price'] = $sheetData[43];
                    $kampanya['priority'] = 0;

                } else {
                    $product_data['price'] = $sheetData[43] != '' ? $sheetData[43] : 0;
                }


                // Para Birimi
                if ($sheetData[42] == 'EUR') {
                    $currency_id = 3;
                } elseif ($sheetData[42] == 'USD') {
                    $currency_id = 1;
                } else {
                    $currency_id = 2;
                }
                $product_data['currency_id'] = $currency_id;

                $product = Product::create($product_data);
                if ($kampanya) {
                    $kampanya['product_id'] = $product->id();
                    ProductCampaign::create($kampanya);
                }

                $kategori_id = $this->kategoriNameToIds($sheetData[1]);
                if ($kategori_id > 0) {
                    ProductCategory::create([
                        'product_id' => $product->id(),
                        'category_id' => $kategori_id
                    ]);
                } else {
                    die('KATEGORI BULUNAMADI : ' . $sheetData[1]);
                }

                // Özellikler
                for ($x = 8; $x <= 36; $x++) {
                    $attribute = Attribute::where('name', $sheetDatas[1][$x])->first();
                    if ($attribute) {
                        if ($sheetData[$x] != '') {
                            ProductAttribute::create([
                                'product_id' => $product->id(),
                                'attribute_id' => $attribute->id(),
                                'value' => $sheetData[$x]
                            ]);
                        }
                    } else {
                        die('ÖZELLİK BULUNAMADI' . $sheetDatas[1][$x]);
                    }
                }

            }
        } elseif ($request->input('sheet') == 3) {
            $inputFileName = getcwd() . '/excel.xlsx';

            /** Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $spreadsheet->setActiveSheetIndex(2);
            $sheetDatas = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);

            //  unset($sheetDatas[0]);

            foreach ($sheetDatas as $i => $sheetData) {

                if ($i <= 1) {
                    continue;
                }

                $product_data = [];
                $product_data['status'] = 1;
                $product_data['barcode'] = $sheetData[2];
                $product_data['name'] = $sheetData[3];
                $product_data['seo_name'] = str_slug($sheetData[3]);
                $product_data['brand_id'] = $this->brandCreated($sheetData[4]);
                $product_data['serial_no2'] = $sheetData[5];
                $product_data['serial_no'] = $sheetData[6];
                $product_data['model'] = $sheetData[7];
                $product_data['short_description'] = $sheetData[30];
                $product_data['description'] = $sheetData[32];
                $product_data['stock_status_id'] = 1; // Stokda Var
                $product_data['min_quantity'] = 1;
                $product_data['quantity'] = $sheetData[38] ? $sheetData[38] : 0;

                $kampanya = [];
                if ($sheetData[36] != '') {
                    $product_data['price'] = $sheetData[36];

                    $kampanya['customer_group_id'] = 1; // Default yap
                    $kampanya['price'] = $sheetData[34];
                    $kampanya['priority'] = 0;

                } else {
                    $product_data['price'] = $sheetData[34] != '' ? $sheetData[34] : 0;
                }


// Para Birimi
                if ($sheetData[33] == 'EUR') {
                    $currency_id = 3;
                } elseif ($sheetData[33] == 'USD') {
                    $currency_id = 1;
                } else {
                    $currency_id = 2;
                }
                $product_data['currency_id'] = $currency_id;

                $product = Product::create($product_data);
                if ($kampanya) {
                    $kampanya['product_id'] = $product->id();
                    ProductCampaign::create($kampanya);
                }

                $kategori_id = $this->kategoriNameToIds($sheetData[1]);
                if ($kategori_id > 0) {
                    ProductCategory::create([
                        'product_id' => $product->id(),
                        'category_id' => $kategori_id
                    ]);
                } else {
                    die('KATEGORI BULUNAMADI : ' . $sheetData[1]);
                }

// Özellikler
                for ($x = 8; $x <= 26; $x++) {
                    $attribute = Attribute::where('name', $sheetDatas[1][$x])->first();
                    if ($attribute) {
                        if ($sheetData[$x] != '') {
                            ProductAttribute::create([
                                'product_id' => $product->id(),
                                'attribute_id' => $attribute->id(),
                                'value' => $sheetData[$x]
                            ]);
                        }
                    } else {
                        die('ÖZELLİK BULUNAMADI' . $sheetDatas[1][$x]);
                    }
                }

            }
        } elseif ($request->input('sheet') == 4) {
            $inputFileName = getcwd() . '/excel.xlsx';

            /** Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $spreadsheet->setActiveSheetIndex(3);
            $sheetDatas = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);

            //  unset($sheetDatas[0]);

            foreach ($sheetDatas as $i => $sheetData) {

                if ($i <= 1) {
                    continue;
                }

                $product_data = [];
                $product_data['status'] = 1;
                $product_data['barcode'] = $sheetData[2];
                $product_data['name'] = $sheetData[3];
                $product_data['seo_name'] = str_slug($sheetData[3]);
                $product_data['brand_id'] = $this->brandCreated($sheetData[4]);
                $product_data['serial_no2'] = $sheetData[5];
                $product_data['serial_no'] = $sheetData[6];
                $product_data['model'] = $sheetData[7];
                $product_data['short_description'] = $sheetData[12];
                $product_data['description'] = $sheetData[11];
                $product_data['stock_status_id'] = 1; // Stokda Var
                $product_data['min_quantity'] = 1;
                $product_data['quantity'] = $sheetData[20] ? $sheetData[20] : 0;

                $kampanya = [];
                if ($sheetData[18] != '') {
                    $product_data['price'] = $sheetData[18];

                    $kampanya['customer_group_id'] = 1; // Default yap
                    $kampanya['price'] = $sheetData[16];
                    $kampanya['priority'] = 0;

                } else {
                    $product_data['price'] = $sheetData[16] != '' ? $sheetData[16] : 0;
                }


// Para Birimi
                if ($sheetData[15] == 'EUR') {
                    $currency_id = 3;
                } elseif ($sheetData[15] == 'USD') {
                    $currency_id = 1;
                } else {
                    $currency_id = 2;
                }
                $product_data['currency_id'] = $currency_id;

                $product = Product::create($product_data);
                if ($kampanya) {
                    $kampanya['product_id'] = $product->id();
                    ProductCampaign::create($kampanya);
                }

                $kategori_id = $this->kategoriNameToIds($sheetData[1]);
                if ($kategori_id > 0) {
                    ProductCategory::create([
                        'product_id' => $product->id(),
                        'category_id' => $kategori_id
                    ]);
                } else {
                    die('KATEGORI BULUNAMADI : ' . $sheetData[1]);
                }


            }
        } elseif ($request->input('sheet') == 5) {

            $inputFileName = getcwd() . '/excel.xlsx';

            /** Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
            $spreadsheet->setActiveSheetIndex(4);
            $sheetDatas = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);

            //  unset($sheetDatas[0]);

            foreach ($sheetDatas as $i => $sheetData) {

                if ($i <= 1) {
                    continue;
                }

                $product_data = [];
                $product_data['status'] = 1;
                $product_data['barcode'] = $sheetData[2];
                $product_data['name'] = $sheetData[3];
                $product_data['seo_name'] = str_slug($sheetData[3]);
                $product_data['brand_id'] = $this->brandCreated($sheetData[4]);
                $product_data['serial_no2'] = $sheetData[5];
                $product_data['serial_no'] = $sheetData[6];
                $product_data['model'] = $sheetData[7];
                $product_data['short_description'] = $sheetData[32];
                $product_data['description'] = $sheetData[34];
                $product_data['stock_status_id'] = 1; // Stokda Var
                $product_data['min_quantity'] = 1;
                $product_data['quantity'] = $sheetData[40] ? $sheetData[40] : 0;

                $kampanya = [];
                if ($sheetData[38] != '') {
                    $product_data['price'] = $sheetData[38];

                    $kampanya['customer_group_id'] = 1; // Default yap
                    $kampanya['price'] = $sheetData[36];
                    $kampanya['priority'] = 0;

                } else {
                    $product_data['price'] = $sheetData[36] != '' ? $sheetData[36] : 0;
                }


// Para Birimi
                if ($sheetData[35] == 'EUR') {
                    $currency_id = 3;
                } elseif ($sheetData[35] == 'USD') {
                    $currency_id = 1;
                } else {
                    $currency_id = 2;
                }
                $product_data['currency_id'] = $currency_id;

                $product = Product::create($product_data);
                if ($kampanya) {
                    $kampanya['product_id'] = $product->id();
                    ProductCampaign::create($kampanya);
                }

                $kategori_id = $this->kategoriNameToIds($sheetData[1]);
                if ($kategori_id > 0) {
                    ProductCategory::create([
                        'product_id' => $product->id(),
                        'category_id' => $kategori_id
                    ]);
                } else {
                    die('KATEGORI BULUNAMADI : ' . $sheetData[1]);
                }

// Özellikler
                for ($x = 8; $x <= 28; $x++) {
                    $attribute = Attribute::where('name', $sheetDatas[1][$x])->first();
                    if ($attribute) {
                        if ($sheetData[$x] != '') {
                            ProductAttribute::create([
                                'product_id' => $product->id(),
                                'attribute_id' => $attribute->id(),
                                'value' => $sheetData[$x]
                            ]);
                        }
                    } else {
                        die('ÖZELLİK BULUNAMADI' . $sheetDatas[1][$x]);
                    }
                }

            }
        }

        return view('frontend.home.maintenance');
    }
}
