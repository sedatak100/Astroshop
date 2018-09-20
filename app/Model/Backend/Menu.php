<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public static function menus()
    {
        $menus = [
            [
                'name' => __('backend/layouts/menu.home'),
                'link' => route('backend.home.index'),
                'icon' => 'ua-icon-home',
                'children' => []
            ],
            [
                'name' => __('backend/layouts/menu.products'),
                'link' => '#',
                'icon' => 'ua-icon-ui',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.product_lists'),
                        'link' => route('backend.product.lists'),
                        'selected' => [
                            'backend.product.lists', 'backend.product.add',
                            'backend.product.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.category_lists'),
                        'link' => route('backend.product.category.lists', ['id' => 0]),
                        'selected' => [
                            'backend.product.category.lists', 'backend.product.category.add',
                            'backend.product.category.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.brand_lists'),
                        'link' => route('backend.product.brand.lists'),
                        'selected' => [
                            'backend.product.brand.lists', 'backend.product.brand.add',
                            'backend.product.brand.edit'
                        ],
                        'children' => []
                    ],
                    /*
                    [
                        'name' => __('backend/layouts/menu.filter_lists'),
                        'link' => route('backend.product.filter.lists'),
                        'selected' => [
                            'backend.product.filter.lists', 'backend.product.filter.add',
                            'backend.product.filter.edit'
                        ],
                        'children' => []
                    ],
                    */
                    [
                        'name' => __('backend/layouts/menu.attribute_lists'),
                        'link' => route('backend.product.attribute.lists'),
                        'selected' => [
                            'backend.product.attribute.lists', 'backend.product.attribute.add',
                            'backend.product.attribute.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.download_lists'),
                        'link' => route('backend.product.download.lists'),
                        'selected' => [
                            'backend.product.download.lists', 'backend.product.download.add',
                            'backend.product.download.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.icon_lists'),
                        'link' => route('backend.product.icon.lists'),
                        'selected' => [
                            'backend.product.icon.lists', 'backend.product.icon.add',
                            'backend.product.icon.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.coupon_lists'),
                        'link' => route('backend.coupon.lists'),
                        'selected' => [
                            'backend.coupon.lists', 'backend.coupon.add',
                            'backend.coupon.edit'
                        ],
                        'children' => []
                    ],
                ]
            ],
            [
                'name' => __('backend/layouts/menu.orders'),
                'link' => '#',
                'icon' => 'ua-icon-widget-cart',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.order_lists'),
                        'link' => route('backend.order.lists'),
                        'selected' => [
                            'backend.order.lists',  'backend.order.view'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.tickets'),
                'link' => '#',
                'icon' => 'ua-icon-help-circle',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.ticket_lists'),
                        'link' => route('backend.ticket.lists'),
                        'selected' => [
                            'backend.ticket.lists',  'backend.ticket.view'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.customers'),
                'link' => '#',
                'icon' => 'ua-icon-profile',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.customer_lists'),
                        'link' => route('backend.customer.lists'),
                        'selected' => [
                            'backend.customer.lists', 'backend.customer.add', 'backend.customer.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.customer_groups'),
                        'link' => route('backend.customer.group.lists'),
                        'selected' => [
                            'backend.customer.group.lists', 'backend.customer.group.add', 'backend.customer.group.edit'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.contacts'),
                'link' => '#',
                'icon' => 'ua-icon-widget-cart',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.contacts_form_lists'),
                        'link' => route('backend.contact.form.lists'),
                        'selected' => [
                            'backend.contact.form.lists', 'backend.contact.form.view'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.posters'),
                'link' => '#',
                'icon' => 'ua-icon-timeline-alt',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.poster_lists'),
                        'link' => route('backend.poster.lists'),
                        'selected' => [
                            'backend.poster.lists', 'backend.poster.add', 'backend.poster.edit'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.shipping_methods'),
                'link' => '#',
                'icon' => 'ua-icon-widget-company',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.shipping_method_free'),
                        'link' => route('backend.shipping_method.free.edit'),
                        'selected' => [
                            'backend.shipping_method.free.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.shipping_method_fixed'),
                        'link' => route('backend.shipping_method.fixed.edit'),
                        'selected' => [
                            'backend.shipping_method.fixed.edit'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.payment_methods'),
                'link' => '#',
                'icon' => 'ua-icon-money-bag',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.payment_method_bank_transfer'),
                        'link' => route('backend.payment_method.bank_transfer.edit'),
                        'selected' => [
                            'backend.payment_method.bank_transfer.edit'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.users'),
                'link' => '#',
                'icon' => 'ua-icon-user-outline',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.user_lists'),
                        'link' => route('backend.user.lists'),
                        'selected' => [
                            'backend.user.lists', 'backend.user.add', 'backend.user.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.user_groups'),
                        'link' => route('backend.user.group.lists'),
                        'selected' => [
                            'backend.user.group.lists', 'backend.user.group.add', 'backend.user.group.edit'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.pages'),
                'link' => '#',
                'icon' => 'ua-icon-pages',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.page_lists'),
                        'link' => route('backend.page.lists', ['id' => 0]),
                        'selected' => [
                            'backend.page.lists', 'backend.page.add', 'backend.page.edit'
                        ],
                        'children' => []
                    ]
                ]
            ],
            [
                'name' => __('backend/layouts/menu.system'),
                'link' => '#',
                'icon' => 'ua-icon-settings',
                'children' => [
                    [
                        'name' => __('backend/layouts/menu.config'),
                        'link' => route('backend.config.edit'),
                        'selected' => [
                            'backend.config.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.currency'),
                        'link' => route('backend.currency.lists'),
                        'selected' => [
                            'backend.currency.lists', 'backend.currency.add', 'backend.currency.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.region'),
                        'link' => route('backend.region.lists'),
                        'selected' => [
                            'backend.region.lists', 'backend.region.add', 'backend.region.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.country_city_district'),
                        'link' => route('backend.region.country.lists'),
                        'selected' => [
                            'backend.region.country.lists', 'backend.region.country.add', 'backend.region.country.edit',
                            'backend.region.city.lists', 'backend.region.city.add', 'backend.region.city.edit',
                            'backend.region.district.lists', 'backend.region.district.add',
                            'backend.region.district.edit',
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.weight'),
                        'link' => route('backend.unit.weight.lists'),
                        'selected' => [
                            'backend.unit.weight.lists', 'backend.unit.weight.add', 'backend.unit.weight.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.length'),
                        'link' => route('backend.unit.length.lists'),
                        'selected' => [
                            'backend.unit.length.lists', 'backend.unit.length.add', 'backend.unit.length.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.tax_rate'),
                        'link' => route('backend.tax.rate.lists'),
                        'selected' => [
                            'backend.tax.rate.lists', 'backend.tax.rate.add', 'backend.tax.rate.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.tax_class'),
                        'link' => route('backend.tax.class.lists'),
                        'selected' => [
                            'backend.tax.class.lists', 'backend.tax.class.add', 'backend.tax.class.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.stock_status'),
                        'link' => route('backend.status.stock_status.lists'),
                        'selected' => [
                            'backend.status.stock_status.lists', 'backend.status.stock_status.add',
                            'backend.status.stock_status.edit'
                        ],
                        'children' => []
                    ],
                    [
                        'name' => __('backend/layouts/menu.order_status'),
                        'link' => route('backend.status.order_status.lists'),
                        'selected' => [
                            'backend.status.order_status.lists', 'backend.status.order_status.add',
                            'backend.status.order_status.edit'
                        ],
                        'children' => []
                    ]
                ]
            ]
        ];
        return $menus;
    }
}
