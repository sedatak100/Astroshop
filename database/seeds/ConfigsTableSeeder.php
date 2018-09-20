<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Varsayılan Ülke
            [
                'group' => 'config',
                'key' => 'default_country',
                'value' => '',
                'serialized' => 0
            ],
            // Varsayılan Para Birimi
            [
                'group' => 'config',
                'key' => 'currency',
                'value' => '',
                'serialized' => 0
            ],
            // Admin Paneli Tablo listemelerindeki satır sayısı
            [
                'group' => 'backend',
                'key' => 'paginate',
                'value' => '',
                'serialized' => 0
            ],
            // Varsayılan Ağırlık
            [
                'group' => 'config',
                'key' => 'weight',
                'value' => '',
                'serialized' => 0
            ],
            // Varsayılan Uzunluk
            [
                'group' => 'config',
                'key' => 'length',
                'value' => '',
                'serialized' => 0
            ],
            // Varsayılan Stok Durumu
            [
                'group' => 'config',
                'key' => 'stock_status',
                'value' => '',
                'serialized' => 0
            ],
            // Varsayılan Müşteri Grubu
            [
                'group' => 'config',
                'key' => 'customer_group',
                'value' => 0,
                'serialized' => 0
            ],
            // Varsayılan Vergi Sınıfı
            [
                'group' => 'config',
                'key' => 'tax_class',
                'value' => '',
                'serialized' => 0
            ],
            // Ürün Resim Limiti
            [
                'group' => 'config',
                'key' => 'product_image_limit',
                'value' => '5',
                'serialized' => 0
            ],
            // Admin Paneli Stok Uyarı Limiti
            [
                'group' => 'backend',
                'key' => 'stock_alert',
                'value' => '10',
                'serialized' => 0
            ],
            [
                'group' => 'config',
                'key' => 'customer_contract',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'config',
                'key' => 'tax_show',
                'value' => '',
                'serialized' => 0
            ],
            // Adres
            [
                'group' => 'store',
                'key' => 'address',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'store',
                'key' => 'phone',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'store',
                'key' => 'gsm',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'store',
                'key' => 'email',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'store',
                'key' => 'facebook',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'store',
                'key' => 'twitter',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'store',
                'key' => 'instagram',
                'value' => '',
                'serialized' => 0
            ],
            [
                'group' => 'store',
                'key' => 'youtube',
                'value' => '',
                'serialized' => 0
            ],
            // Tema Ayarları
            // Üst Menü Kategoriler
            [
                'group' => 'theme',
                'key' => 'top_categories',
                'value' => '',
                'serialized' => 1
            ],
            // Anasayfa Slider
            [
                'group' => 'theme',
                'key' => 'home_poster',
                'value' => '',
                'serialized' => 0
            ],
            // Anasayfa Kategoriler
            [
                'group' => 'theme',
                'key' => 'home_categories',
                'value' => '',
                'serialized' => 1
            ],
            // Haftanın Fırsatı
            [
                'group' => 'theme',
                'key' => 'week_product',
                'value' => '',
                'serialized' => 0
            ],
            // Anasayfa En Çok Satılanlar
            [
                'group' => 'theme',
                'key' => 'most_sales',
                'value' => '',
                'serialized' => 1
            ],
            // Anasayfa Kampanyalı Ürünler
            [
                'group' => 'theme',
                'key' => 'home_campaign_product',
                'value' => '',
                'serialized' => 1
            ],
            // Footer Sayfalar
            [
                'group' => 'theme',
                'key' => 'footer_pages',
                'value' => '',
                'serialized' => 1
            ],
            // Anasayfa Bankalar
            [
                'group' => 'theme',
                'key' => 'home_bank',
                'value' => '',
                'serialized' => 0
            ],
            // Anasayfa Teslimat Yazıları
            [
                'group' => 'theme',
                'key' => 'home_delivered',
                'value' => '',
                'serialized' => 0
            ],
            // Ürün Liste İkonu
            [
                'group' => 'theme',
                'key' => 'icon_new',
                'value' => '',
                'serialized' => 0
            ],
            // Ürün Detay İkonları
            [
                'group' => 'theme',
                'key' => 'product_detail_icons',
                'value' => '',
                'serialized' => 1
            ],
            // Anasayfa Astronomi Güncesi
            [
                'group' => 'theme',
                'key' => 'home_page_middle',
                'value' => '',
                'serialized' => 0
            ],
            // Anasayfa Kampanyalı Ürünler
            [
                'group' => 'theme',
                'key' => 'home_campaigns',
                'value' => '',
                'serialized' => 0
            ],
            // Kargo Methodları
            [
                'group' => 'shipping',
                'key' => 'methods',
                'value' => [
                    ['free', 'fixed']
                ],
                'serialized' => 1
            ],
            // Ödeme Methodları
            [
                'group' => 'payment',
                'key' => 'methods',
                'value' => [
                    ['bank_transfer']
                ],
                'serialized' => 1
            ],
            // Tamamlanan Sipariş Durumları
            [
                'group' => 'status_completed',
                'key' => 'detail',
                'value' => [],
                'serialized' => 1
            ],
            // Resim Boyutları
            [
                'group' => 'product_image',
                'key' => 'list',
                'value' => [
                    ['x' => '', 'y' => '']
                ],
                'serialized' => 1
            ],
            [
                'group' => 'product_image',
                'key' => 'big',
                'value' => [
                    ['x' => '', 'y' => '']
                ],
                'serialized' => 1
            ],
            [
                'group' => 'product_image',
                'key' => 'detail',
                'value' => [
                    ['x' => '', 'y' => '']
                ],
                'serialized' => 1
            ],
        ];
        \App\Model\Configs\Config::insert($data);
    }
}
