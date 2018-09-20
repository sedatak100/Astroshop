<?php

namespace App\Model\Backend;

class UserPermission
{
    public static function permissions(): array
    {
        return [
            [
                'name' => 'Kullanıcı Yönetimi',
                'roles' => [
                    [
                        'name' => 'Kullanıcıları Listele',
                        'routes' => [
                            'backend.user.lists'
                        ]
                    ],
                    [
                        'name' => 'Kullanıcı Ekle',
                        'routes' => [
                            'backend.user.add', 'backend.user.added'
                        ]
                    ],
                    [
                        'name' => 'Kullanıcı Düzenle',
                        'routes' => [
                            'backend.user.edit', 'backend.user.edited'
                        ]
                    ],
                    [
                        'name' => 'Kullanıcı Sil',
                        'routes' => [
                            'backend.user.remove'
                        ]
                    ],
                    [
                        'name' => 'Yetkileri Listele',
                        'routes' => [
                            'backend.user.group.lists'
                        ]
                    ],
                    [
                        'name' => 'Yetki Ekle',
                        'routes' => [
                            'backend.user.group.add', 'backend.user.group.added'
                        ]
                    ],
                    [
                        'name' => 'Yetki Düzenle',
                        'routes' => [
                            'backend.user.group.edit', 'backend.user.group.edited'
                        ]
                    ],
                    [
                        'name' => 'Yetki Sil',
                        'routes' => [
                            'backend.user.group.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Ürün Yönetimi',
                'roles' => [
                    [
                        'name' => 'Ürün Listele',
                        'routes' => [
                            'backend.product.lists'
                        ]
                    ],
                    [
                        'name' => 'Ürün Ekle',
                        'routes' => [
                            'backend.product.add', 'backend.product.added'
                        ]
                    ],
                    [
                        'name' => 'Ürün Düzenle',
                        'routes' => [
                            'backend.product.edit', 'backend.product.edited'
                        ]
                    ],
                    [
                        'name' => 'Ürün Sil',
                        'routes' => [
                            'backend.product.remove'
                        ]
                    ],
                    [
                        'name' => 'Kategori Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.product.category.lists', 'backend.product.category.add',
                            'backend.product.category.added', 'backend.product.category.edit',
                            'backend.product.category.edited', 'backend.product.category.remove'
                        ]
                    ],
                    [
                        'name' => 'Marka Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.product.brand.lists', 'backend.product.brand.add',
                            'backend.product.brand.added', 'backend.product.brand.edit',
                            'backend.product.brand.edited', 'backend.product.brand.remove'
                        ]
                    ],
                    [
                        'name' => 'Filtre Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.product.filter.lists', 'backend.product.filter.add',
                            'backend.product.filter.added', 'backend.product.filter.edit',
                            'backend.product.filter.edited', 'backend.product.filter.remove'
                        ]
                    ],
                    [
                        'name' => 'Özellik Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.product.attribute.lists', 'backend.product.attribute.add',
                            'backend.product.attribute.added', 'backend.product.attribute.edit',
                            'backend.product.attribute.edited', 'backend.product.attribute.remove'
                        ]
                    ],
                    [
                        'name' => 'Dosyalar Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.product.download.lists', 'backend.product.download.add',
                            'backend.product.download.added', 'backend.product.download.edit',
                            'backend.product.download.edited', 'backend.product.download.remove'
                        ]
                    ],
                    [
                        'name' => 'Icon Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.product.icon.lists', 'backend.product.icon.add',
                            'backend.product.icon.added', 'backend.product.icon.edit',
                            'backend.product.icon.edited', 'backend.product.icon.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Müşteri Yönetimi',
                'roles' => [
                    [
                        'name' => 'Müşterileri Listele',
                        'routes' => [
                            'backend.customer.lists'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Ekle',
                        'routes' => [
                            'backend.customer.add', 'backend.customer.added'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Düzenle',
                        'routes' => [
                            'backend.customer.edit', 'backend.customer.edited'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Sil',
                        'routes' => [
                            'backend.customer.remove'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Adres Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.customer.address.added', 'backend.customer.address.edited',
                            'backend.customer.address.remove'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Grupları Listele',
                        'routes' => [
                            'backend.customer.group.lists'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Grubu Ekle',
                        'routes' => [
                            'backend.customer.group.add', 'backend.customer.group.added'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Grubu Düzenle',
                        'routes' => [
                            'backend.customer.group.edit', 'backend.customer.group.edited'
                        ]
                    ],
                    [
                        'name' => 'Müşteri Grubu Sil',
                        'routes' => [
                            'backend.customer.group.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Poster Yönetimi',
                'roles' => [
                    [
                        'name' => 'Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.poster.lists', 'backend.poster.add', 'backend.poster.added',
                            'backend.poster.edit', 'backend.poster.edited', 'backend.poster.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Sipariş Yönetimi',
                'roles' => [
                    [
                        'name' => 'Listele',
                        'routes' => [
                            'backend.order.lists'
                        ]
                    ],
                    [
                        'name' => 'Detay',
                        'routes' => [
                            'backend.order.view'
                        ]
                    ],
                    [
                        'name' => 'Sipariş Durumu Güncelle',
                        'routes' => [
                            'backend.order.history_add'
                        ]
                    ],
                    [
                        'name' => 'Sipariş Sil',
                        'routes' => [
                            'backend.order.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'İletişim Yönetimi',
                'roles' => [
                    [
                        'name' => 'Form Mesajlarını Listele',
                        'routes' => [
                            'backend.contact.form.lists'
                        ]
                    ],
                    [
                        'name' => 'Form Mesajlarını Oku',
                        'routes' => [
                            'backend.contact.form.view'
                        ]
                    ],
                    [
                        'name' => 'Form Mesajı Sil',
                        'routes' => [
                            'backend.contact.form.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Kupon Yönetimi',
                'roles' => [
                    [
                        'name' => 'Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.coupon.lists', 'backend.coupon.add', 'backend.coupon.added',
                            'backend.coupon.edit', 'backend.coupon.edited', 'backend.coupon.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Destek Yönetimi',
                'roles' => [
                    [
                        'name' => 'Listele / Görüntüle / Kapat',
                        'routes' => [
                            'backend.ticket.lists', 'backend.ticket.view', 'backend.ticket.closed'
                        ]
                    ],
                    [
                        'name' => 'Cevapla',
                        'routes' => [
                            'backend.ticket.reply.added'
                        ]
                    ],
                    [
                        'name' => 'Sil',
                        'routes' => [
                            'backend.ticket.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Kargo Method Yönetimi',
                'roles' => [
                    [
                        'name' => 'Düzenle',
                        'routes' => [
                            'backend.shipping_method.free.edit', 'backend.shipping_method.free.edited',
                            'backend.shipping_method.fixed.edit', 'backend.shipping_method.fixed.edited'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Ödeme Method Yönetimi',
                'roles' => [
                    [
                        'name' => 'Düzenle',
                        'routes' => [
                            'backend.payment_method.bank_transfer.edit', 'backend.payment_method.bank_transfer.edited',
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Sayfa Yönetimi',
                'roles' => [
                    [
                        'name' => 'Ekle / Düzenle / Sil',
                        'routes' => [
                            'backend.page.lists', 'backend.page.add', 'backend.page.added',
                            'backend.page.edit', 'backend.page.edited', 'backend.page.remove'
                        ]
                    ]
                ],
            ],
            [
                'name' => 'Sistem Ayarları',
                'roles' => [
                    [
                        'name' => 'Genel Ayarları Yönetme',
                        'routes' => [
                            'backend.config.edit', 'backend.config.edited'
                        ]
                    ],
                    [
                        'name' => 'Para Birimi Yönetme',
                        'routes' => [
                            'backend.currency.lists', 'backend.currency.add', 'backend.currency.added',
                            'backend.currency.edit', 'backend.currency.edited', 'backend.currency.remove',
                            'backend.currency.update'
                        ]
                    ],
                    [
                        'name' => 'Bölge Kapsamları',
                        'routes' => [
                            'backend.region.lists',
                            'backend.region.add', 'backend.region.added',
                            'backend.region.edit', 'backend.region.edited',
                            'backend.region.remove'
                        ]
                    ],
                    [
                        'name' => 'Ülke / Şehir / İlçe Yönetimi',
                        'routes' => [
                            // Country
                            'backend.region.country.lists',
                            'backend.region.country.add', 'backend.region.country.added',
                            'backend.region.country.edit', 'backend.region.country.edited',
                            'backend.region.country.remove',
                            // City
                            'backend.region.city.lists',
                            'backend.region.city.add', 'backend.region.city.added',
                            'backend.region.city.edit', 'backend.region.city.edited',
                            'backend.region.city.remove',
                            // City
                            'backend.region.district.lists',
                            'backend.region.district.add', 'backend.region.district.added',
                            'backend.region.district.edit', 'backend.region.district.edited',
                            'backend.region.district.remove'
                        ]
                    ],
                    [
                        'name' => 'Ağırlık Birimleri',
                        'routes' => [
                            'backend.unit.weight.lists',
                            'backend.unit.weight.add', 'backend.unit.weight.added',
                            'backend.unit.weight.edit', 'backend.unit.weight.edited',
                            'backend.unit.weight.remove'
                        ]
                    ],
                    [
                        'name' => 'Uzunluk Birimleri',
                        'routes' => [
                            'backend.unit.length.lists',
                            'backend.unit.length.add', 'backend.unit.length.added',
                            'backend.unit.length.edit', 'backend.unit.length.edited',
                            'backend.unit.length.remove'
                        ]
                    ],
                    [
                        'name' => 'Stok Durumları',
                        'routes' => [
                            'backend.status.stock_status.lists',
                            'backend.status.stock_status.add', 'backend.status.stock_status.added',
                            'backend.status.stock_status.edit', 'backend.status.stock_status.edited',
                            'backend.status.stock_status.remove'
                        ]
                    ],
                    [
                        'name' => 'Sipariş Durumları',
                        'routes' => [
                            'backend.status.order_status.lists',
                            'backend.status.order_status.add', 'backend.status.order_status.added',
                            'backend.status.order_status.edit', 'backend.status.order_status.edited',
                            'backend.status.order_status.remove'
                        ]
                    ],
                    [
                        'name' => 'Vergi Yönetimi',
                        'routes' => [
                            'backend.tax.class.lists',
                            'backend.tax.class.add', 'backend.tax.class.added',
                            'backend.tax.class.edit', 'backend.tax.class.edited', 'backend.tax.class.remove',
                            'backend.tax.rate.lists',
                            'backend.tax.rate.add', 'backend.tax.rate.added',
                            'backend.tax.rate.edit', 'backend.tax.rate.edited', 'backend.tax.rate.remove'
                        ]
                    ],
                ],
            ]
        ];
    }
}
