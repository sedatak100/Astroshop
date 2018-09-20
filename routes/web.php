<?php /** @noinspection ALL */

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Frontend Router
 *
 */
Route::name('frontend.')->namespace('Frontend')->prefix('/')->middleware(['frontend.autoloader', 'frontend.carttransfer'])->group(function () {
    $this->get('/', 'Home\HomeController@index')->name('home.index');
    $this->get(__('frontend/route.maintenance.view'), 'Home\MaintenanceController@view')->name('maintenance.view');
    $this->get(__('frontend/route.maintenance.open'), 'Home\MaintenanceController@open')->name('maintenance.open');
    Route::middleware('guest')->namespace('Auth')->group(function () {
        $this->get(__('frontend/route.auth.login'), 'LoginController@showLoginForm')->name('login');
        $this->post(__('frontend/route.auth.login'), 'LoginController@login');
        $this->get(__('frontend/route.auth.register'), 'RegisterController@showRegistrationForm')->name('register');
        $this->post(__('frontend/route.auth.register'), 'RegisterController@register');
    });

    Route::name('product.')->namespace('Products')->group(function () {
        $this->get(__('frontend/route.product.category.lists') . '/{seo_name}', 'CategoryController@lists')->name('category.lists');
        $this->get(__('frontend/route.product.search.lists'), 'SearchController@lists')->name('search.lists');
        $this->get(__('frontend/route.product.brand.product') . '/{seo_name}', 'BrandController@products')->name('brand.products');
        $this->get(__('frontend/route.product.view') . '/{seo_name}', 'ProductController@view')->name('view');
    });

    Route::name('page.')->namespace('Pages')->group(function () {
        $this->get(__('frontend/route.page.view') . '/{seo_name}', 'PageController@view')->name('view');
    });

    Route::name('cart.')->namespace('Carts')->group(function () {
        $this->post(__('frontend/route.cart.add'), 'CartController@add')->name('add');
        $this->post(__('frontend/route.cart.update_multiple'), 'CartController@updateMultiple')->name('update_multiple');
        $this->post(__('frontend/route.cart.remove'), 'CartController@remove')->name('remove');
        $this->get(__('frontend/route.cart.basket.view'), 'BasketController@view')->name('basket.view');
        $this->post(__('frontend/route.cart.coupon.uses'), 'CouponController@uses')->name('coupon.uses');
        $this->post(__('frontend/route.cart.coupon.remove'), 'CouponController@remove')->name('coupon.remove');

        $this->get(__('frontend/route.cart.basket.logged'), 'BasketController@logged')->name('basket.logged');
        $this->get(__('frontend/route.cart.shipping.view'), 'ShippingController@view')->name('shipping.view');
        $this->post(__('frontend/route.cart.shipping.added'), 'ShippingController@added')->name('shipping.added');

        $this->any(__('frontend/route.cart.payment.view') . '/{id}', 'PaymentController@view')->name('payment.view');
        $this->get(__('frontend/route.cart.success.view') . '/{id}', 'SuccessController@view')->name('success.view');
    });

    Route::name('account.')->middleware('auth')->namespace('Accounts')->group(function () {
        $this->get(__('frontend/route.account.view'), 'AccountController@view')->name('view');
        $this->post(__('frontend/route.account.edit'), 'AccountController@edited')->name('edit');
        $this->post(__('frontend/route.account.address.edit'), 'AddressController@edited')->name('address.edit');

        $this->get(__('frontend/route.account.order.lists'), 'OrderController@lists')->name('order.lists');
        $this->get(__('frontend/route.account.order.view') . '/{id}', 'OrderController@view')->name('order.view');

        $this->get(__('frontend/route.account.ticket.lists'), 'TicketController@lists')->name('ticket.lists');
        $this->post(__('frontend/route.account.ticket.lists'), 'TicketController@added')->name('ticket.added');
        $this->get(__('frontend/route.account.ticket.view') . '/{id}', 'TicketController@view')->name('ticket.view');

        $this->post(__('frontend/route.account.ticket.reply.added') . '/{ticket_id}', 'TicketController@replyAdded')->name('ticket.reply.added');
    });

    Route::name('contact.')->namespace('Contacts')->group(function () {
        $this->get(__('frontend/route.contact.form'), 'FormController@form')->name('form');
        $this->post(__('frontend/route.contact.form'), 'FormController@added')->name('form.added');
    });

    Route::middleware('auth')->group(function () {
        $this->get(__('frontend/route.auth.logout'), 'Auth\LoginController@logout')->name('logout');
    });

    Route::name('xhr.')->namespace('Xhrs')->prefix('Xhr')->group(function () {
        $this->get('/district_city_country', 'RegionController@districtCityCountry')->name('region.district_city_country');
        $this->get('/countries', 'RegionController@countries')->name('region.countries');
        $this->get('/cities_by_country', 'RegionController@citiesByCountry')->name('region.cities_by_country');
        $this->get('/districts_by_city', 'RegionController@districtsByCity')->name('region.districts_by_city');
    });

});


/**
 * Backend Router
 *
 */
Route::name('backend.')->namespace('Backend')->prefix('Backend')->group(function () {
    Route::middleware('guest:user')->group(function () {
        $this->get('/login', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('/login', 'Auth\LoginController@login');
    });

    /**
     * Backend auth route
     */
    Route::middleware('auth:user', 'backend.autoloaderisauth', 'backend.permission')->group(function () {
        $this->get('/logout', 'Auth\LoginController@logout')->name('logout');
        $this->get('/home', 'Home\HomeController@index')->name('home.index');

        Route::name('user.')->namespace('Users')->prefix('Users')->group(function () {
            $this->get('/lists', 'UserController@lists')->name('lists');
            $this->get('/add', 'UserController@add')->name('add');
            $this->post('/add', 'UserController@added')->name('added');
            $this->get('/edit/{id}', 'UserController@edit')->name('edit');
            $this->post('/edited/{id}', 'UserController@edited')->name('edited');
            $this->post('/remove/{id}', 'UserController@remove')->name('remove');

            $this->get('/group_lists', 'UserGroupController@lists')->name('group.lists');
            $this->get('/group_add', 'UserGroupController@add')->name('group.add');
            $this->post('/group_added', 'UserGroupController@added')->name('group.added');
            $this->get('/group_edit/{id}', 'UserGroupController@edit')->name('group.edit');
            $this->post('/group_edited/{id}', 'UserGroupController@edited')->name('group.edited');
            $this->post('/group_remove/{id}', 'UserGroupController@remove')->name('group.remove');
        });

        Route::name('currency.')->namespace('Currencies')->prefix('Currencies')->group(function () {
            $this->get('/lists', 'CurrencyController@lists')->name('lists');
            $this->get('/add', 'CurrencyController@add')->name('add');
            $this->post('/added', 'CurrencyController@added')->name('added');
            $this->get('/edit/{id}', 'CurrencyController@edit')->name('edit');
            $this->post('/edited/{id}', 'CurrencyController@edited')->name('edited');
            $this->post('/remove/{id}', 'CurrencyController@remove')->name('remove');
            $this->post('/update', 'CurrencyController@update')->name('update');
        });

        Route::name('region.')->namespace('Regions')->prefix('Regions')->group(function () {
            // Region [Scope]
            $this->get('/region_lists', 'RegionController@lists')->name('lists');
            $this->get('/region_add', 'RegionController@add')->name('add');
            $this->post('/region_added', 'RegionController@added')->name('added');
            $this->get('/region_edit/{id}', 'RegionController@edit')->name('edit');
            $this->post('/region_edited/{id}', 'RegionController@edited')->name('edited');
            $this->post('/region_remove/{id}', 'RegionController@remove')->name('remove');
            // Country Route
            $this->get('/country_lists', 'CountryController@lists')->name('country.lists');
            $this->get('/country_add', 'CountryController@add')->name('country.add');
            $this->post('/country_added', 'CountryController@added')->name('country.added');
            $this->get('/country_edit/{id}', 'CountryController@edit')->name('country.edit');
            $this->post('/country_edited/{id}', 'CountryController@edited')->name('country.edited');
            $this->post('/country_remove/{id}', 'CountryController@remove')->name('country.remove');
            // City Route
            $this->get('/city_lists/{country_id}', 'CityController@lists')->name('city.lists');
            $this->get('/city_add/{country_id}', 'CityController@add')->name('city.add');
            $this->post('/city_added/{country_id}', 'CityController@added')->name('city.added');
            $this->get('/city_edit/{id}', 'CityController@edit')->name('city.edit');
            $this->post('/city_edited/{id}', 'CityController@edited')->name('city.edited');
            $this->post('/city_remove/{id}', 'CityController@remove')->name('city.remove');
            // District Route
            $this->get('/district_lists/{city_id}', 'DistrictController@lists')->name('district.lists');
            $this->get('/district_add/{id}', 'DistrictController@add')->name('district.add');
            $this->post('/district_added/{id}', 'DistrictController@added')->name('district.added');
            $this->get('/district_edit/{id}', 'DistrictController@edit')->name('district.edit');
            $this->post('/district_edited/{id}', 'DistrictController@edited')->name('district.edited');
            $this->post('/district_remove/{id}', 'DistrictController@remove')->name('district.remove');
        });

        Route::name('unit.')->namespace('Units')->prefix('Units')->group(function () {
            // Weight Route
            $this->get('/weight_lists', 'WeightController@lists')->name('weight.lists');
            $this->get('/weight_add', 'WeightController@add')->name('weight.add');
            $this->post('/weight_added', 'WeightController@added')->name('weight.added');
            $this->get('/weight_edit/{id}', 'WeightController@edit')->name('weight.edit');
            $this->post('/weight_edited/{id}', 'WeightController@edited')->name('weight.edited');
            $this->post('/weight_remove/{id}', 'WeightController@remove')->name('weight.remove');
            // Length Route
            $this->get('/length_lists', 'LengthController@lists')->name('length.lists');
            $this->get('/length_add', 'LengthController@add')->name('length.add');
            $this->post('/length_added', 'LengthController@added')->name('length.added');
            $this->get('/length_edit/{id}', 'LengthController@edit')->name('length.edit');
            $this->post('/length_edited/{id}', 'LengthController@edited')->name('length.edited');
            $this->post('/length_remove/{id}', 'LengthController@remove')->name('length.remove');
        });

        Route::name('status.')->namespace('Statuses')->prefix('Statuses')->group(function () {
            // Stock Status Route
            $this->get('/stock_status_lists', 'StockStatusController@lists')->name('stock_status.lists');
            $this->get('/stock_status_add', 'StockStatusController@add')->name('stock_status.add');
            $this->post('/stock_status_added', 'StockStatusController@added')->name('stock_status.added');
            $this->get('/stock_status_edit/{id}', 'StockStatusController@edit')->name('stock_status.edit');
            $this->post('/stock_status_edited/{id}', 'StockStatusController@edited')->name('stock_status.edited');
            $this->post('/stock_status_remove/{id}', 'StockStatusController@remove')->name('stock_status.remove');
            // Order Status Route
            $this->get('/order_status_lists', 'OrderStatusController@lists')->name('order_status.lists');
            $this->get('/order_status_add', 'OrderStatusController@add')->name('order_status.add');
            $this->post('/order_status_added', 'OrderStatusController@added')->name('order_status.added');
            $this->get('/order_status_edit/{id}', 'OrderStatusController@edit')->name('order_status.edit');
            $this->post('/order_status_edited/{id}', 'OrderStatusController@edited')->name('order_status.edited');
            $this->post('/order_status_remove/{id}', 'OrderStatusController@remove')->name('order_status.remove');
        });

        Route::name('customer.')->namespace('Customers')->prefix('Customers')->group(function () {
            $this->get('/lists', 'CustomerController@lists')->name('lists');
            $this->get('/add', 'CustomerController@add')->name('add');
            $this->post('/added', 'CustomerController@added')->name('added');
            $this->get('/edit/{id}', 'CustomerController@edit')->name('edit');
            $this->post('/edited/{id}', 'CustomerController@edited')->name('edited');
            $this->post('/remove/{id}', 'CustomerController@remove')->name('remove');

            $this->post('/addressAdded/{customer_id}', 'CustomerController@addressAdded')->name('address.added');
            $this->post('/addressEdited/{id}', 'CustomerController@addressEdited')->name('address.edited');
            $this->post('/addressRemove/{id}', 'CustomerController@addressRemove')->name('address.remove');

            $this->get('/group_lists', 'CustomerGroupController@lists')->name('group.lists');
            $this->get('/group_add', 'CustomerGroupController@add')->name('group.add');
            $this->post('/group_added', 'CustomerGroupController@added')->name('group.added');
            $this->get('/group_edit/{id}', 'CustomerGroupController@edit')->name('group.edit');
            $this->post('/group_edited/{id}', 'CustomerGroupController@edited')->name('group.edited');
            $this->post('/group_remove/{id}', 'CustomerGroupController@remove')->name('group.remove');
        });

        Route::name('product.')->namespace('Products')->prefix('Products')->group(function () {
            $this->get('/lists', 'ProductController@lists')->name('lists');
            $this->get('/add', 'ProductController@add')->name('add');
            $this->post('/add', 'ProductController@added')->name('added');
            $this->get('/edit/{id}', 'ProductController@edit')->name('edit');
            $this->post('/edit/{id}', 'ProductController@edited')->name('edited');
            $this->post('/remove/{id}', 'ProductController@remove')->name('remove');

            $this->get('/category_lists/{id}', 'CategoryController@lists')->name('category.lists'); // {id} parent_id
            $this->get('/category_add/{id}', 'CategoryController@add')->name('category.add'); // {id} parent_id
            $this->post('/category_added/{id}', 'CategoryController@added')->name('category.added'); // {id} parent_id
            $this->get('/category_edit/{id}', 'CategoryController@edit')->name('category.edit'); //
            $this->post('/category_edited/{id}', 'CategoryController@edited')->name('category.edited');
            $this->post('/category_remove/{id}', 'CategoryController@remove')->name('category.remove');

            $this->get('/brand_lists', 'BrandController@lists')->name('brand.lists');
            $this->get('/brand_add', 'BrandController@add')->name('brand.add');
            $this->post('/brand_added', 'BrandController@added')->name('brand.added');
            $this->get('/brand_edit/{id}', 'BrandController@edit')->name('brand.edit');
            $this->post('/brand_edited/{id}', 'BrandController@edited')->name('brand.edited');
            $this->post('/brand_remove/{id}', 'BrandController@remove')->name('brand.remove');

            $this->get('/filter_lists', 'FilterController@lists')->name('filter.lists');
            $this->get('/filter_add', 'FilterController@add')->name('filter.add');
            $this->post('/filter_added', 'FilterController@added')->name('filter.added');
            $this->get('/filter_edit/{id}', 'FilterController@edit')->name('filter.edit');
            $this->post('/filter_edited/{id}', 'FilterController@edited')->name('filter.edited');
            $this->post('/filter_remove/{id}', 'FilterController@remove')->name('filter.remove');

            $this->get('/attribute_lists', 'AttributeController@lists')->name('attribute.lists');
            $this->get('/attribute_add', 'AttributeController@add')->name('attribute.add');
            $this->post('/attribute_added', 'AttributeController@added')->name('attribute.added');
            $this->get('/attribute_edit/{id}', 'AttributeController@edit')->name('attribute.edit');
            $this->post('/attribute_edited/{id}', 'AttributeController@edited')->name('attribute.edited');
            $this->post('/attribute_remove/{id}', 'AttributeController@remove')->name('attribute.remove');

            $this->get('/download_lists', 'DownloadController@lists')->name('download.lists');
            $this->get('/download_add', 'DownloadController@add')->name('download.add');
            $this->post('/download_added', 'DownloadController@added')->name('download.added');
            $this->get('/download_edit/{id}', 'DownloadController@edit')->name('download.edit');
            $this->post('/download_edited/{id}', 'DownloadController@edited')->name('download.edited');
            $this->post('/download_remove/{id}', 'DownloadController@remove')->name('download.remove');

            $this->get('/icon_lists', 'IconController@lists')->name('icon.lists');
            $this->get('/icon_add', 'IconController@add')->name('icon.add');
            $this->post('/icon_added', 'IconController@added')->name('icon.added');
            $this->get('/icon_edit/{id}', 'IconController@edit')->name('icon.edit');
            $this->post('/icon_edited/{id}', 'IconController@edited')->name('icon.edited');
            $this->post('/icon_remove/{id}', 'IconController@remove')->name('icon.remove');
        });

        Route::name('tax.')->namespace('Taxes')->prefix('Taxes')->group(function () {
            $this->get('/rate_lists', 'TaxRateController@lists')->name('rate.lists');
            $this->get('/rate_add', 'TaxRateController@add')->name('rate.add');
            $this->post('/rate_added', 'TaxRateController@added')->name('rate.added');
            $this->get('/rate_edit/{id}', 'TaxRateController@edit')->name('rate.edit');
            $this->post('/rate_edited/{id}', 'TaxRateController@edited')->name('rate.edited');
            $this->post('/rate_remove/{id}', 'TaxRateController@remove')->name('rate.remove');

            $this->get('/class_lists', 'TaxClassController@lists')->name('class.lists');
            $this->get('/class_add', 'TaxClassController@add')->name('class.add');
            $this->post('/class_added', 'TaxClassController@added')->name('class.added');
            $this->get('/class_edit/{id}', 'TaxClassController@edit')->name('class.edit');
            $this->post('/class_edited/{id}', 'TaxClassController@edited')->name('class.edited');
            $this->post('/class_remove/{id}', 'TaxClassController@remove')->name('class.remove');
        });

        Route::name('config.')->namespace('Configs')->prefix('Configs')->group(function () {
            $this->get('/edit', 'ConfigController@edit')->name('edit');
            $this->post('/edit', 'ConfigController@edited')->name('edited');
        });

        Route::name('poster.')->namespace('Posters')->prefix('Posters')->group(function () {
            $this->get('/lists', 'PosterController@lists')->name('lists');
            $this->get('/add', 'PosterController@add')->name('add');
            $this->post('/added', 'PosterController@added')->name('added');
            $this->get('/edit/{id}', 'PosterController@edit')->name('edit');
            $this->post('/edited/{id}', 'PosterController@edited')->name('edited');
            $this->post('/remove/{id}', 'PosterController@remove')->name('remove');
        });

        Route::name('page.')->namespace('Pages')->prefix('Pages')->group(function () {
            $this->get('/lists/{id}', 'PageController@lists')->name('lists'); // {id} parent_id
            $this->get('/add/{id}', 'PageController@add')->name('add'); // {id} parent_id
            $this->post('/added/{id}', 'PageController@added')->name('added'); // {id} parent_id
            $this->get('/edit/{id}', 'PageController@edit')->name('edit'); //
            $this->post('/edited/{id}', 'PageController@edited')->name('edited');
            $this->post('/remove/{id}', 'PageController@remove')->name('remove');
        });

        Route::name('coupon.')->namespace('Coupons')->prefix('Coupon')->group(function () {
            $this->get('/lists', 'CouponController@lists')->name('lists');
            $this->get('/add', 'CouponController@add')->name('add');
            $this->post('/add', 'CouponController@added')->name('added');
            $this->get('/edit/{id}', 'CouponController@edit')->name('edit');
            $this->post('/edit/{id}', 'CouponController@edited')->name('edited');
            $this->post('/remove/{id}', 'CouponController@remove')->name('remove');
        });

        Route::name('shipping_method.')->namespace('ShippingMethods')->prefix('ShippingMethod')->group(function () {
            $this->get('/free_edit', 'FreeController@edit')->name('free.edit');
            $this->post('/free_edit', 'FreeController@edited')->name('free.edited');
            $this->get('/fixed_edit', 'FixedController@edit')->name('fixed.edit');
            $this->post('/fixed_edit', 'FixedController@edited')->name('fixed.edited');
        });

        Route::name('payment_method.')->namespace('PaymentMethods')->prefix('PaymentMethod')->group(function () {
            $this->get('/bank_transfer_edit', 'BankTransferController@edit')->name('bank_transfer.edit');
            $this->post('/bank_transfer_edit', 'BankTransferController@edited')->name('bank_transfer.edited');
        });

        Route::name('order.')->namespace('Orders')->prefix('Order')->group(function () {
            $this->get('/lists', 'OrderController@lists')->name('lists');
            $this->get('/view/{id}', 'OrderController@view')->name('view');
            $this->post('/remove/{id}', 'OrderController@remove')->name('remove');
            $this->post('/history_add/{id}', 'OrderController@historyAdd')->name('history_add');
            $this->post('/remove/{id}', 'OrderController@remove')->name('remove');
        });

        Route::name('contact.')->namespace('Contacts')->prefix('Contact')->group(function () {
            $this->get('/form_lists', 'FormController@lists')->name('form.lists');
            $this->get('/form_view/{id}', 'FormController@view')->name('form.view');
            $this->post('/form_remove/{id}', 'FormController@remove')->name('form.remove');
        });

        Route::name('ticket.')->namespace('Tickets')->prefix('Ticket')->group(function () {
            $this->get('/lists', 'TicketController@lists')->name('lists');
            $this->get('/view/{id}', 'TicketController@view')->name('view');
            $this->get('/remove/{id}', 'TicketController@remove')->name('remove');
            $this->post('/reply_added/{ticket_id}', 'TicketController@replyAdded')->name('reply.added');
            $this->post('/ticket_close/{id}', 'TicketController@closed')->name('closed');
        });

    });

    Route::name('api.')->namespace('Api')->prefix('Api')->middleware('auth:user', 'backend.autoloaderisauth')->group(function () {
        $this->get('/district_city_country', 'RegionController@districtCityCountry')->name('region.district_city_country');
        $this->get('/countries', 'RegionController@countries')->name('region.countries');
        $this->get('/cities_by_country', 'RegionController@citiesByCountry')->name('region.cities_by_country');
        $this->get('/districts_by_city', 'RegionController@districtsByCity')->name('region.districts_by_city');

        $this->get('/search_brands', 'SearchController@brands')->name('search.brands');
        $this->get('/search_categories', 'SearchController@categories')->name('search.categories');
        $this->get('/search_customer_groups', 'SearchController@customerGroups')->name('search.customer_groups');
        $this->get('/search_downloads', 'SearchController@downloads')->name('search.downloads');
        $this->get('/search_filters', 'SearchController@filters')->name('search.filters');
        $this->get('/search_products', 'SearchController@products')->name('search.products');
        $this->get('/search_attributes', 'SearchController@attributes')->name('search.attributes');
        $this->get('/search_icons', 'SearchController@icons')->name('search.icons');
        $this->get('/search_posters', 'SearchController@posters')->name('search.posters');
        $this->get('/search_pages', 'SearchController@pages')->name('search.pages');
    });

});
