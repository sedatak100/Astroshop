var Cart = function () {

    this.add = function (product_id, quantity, options) {
        var data = [];
        $.ajax({
            async: false,
            method: "POST",
            url: GC.url.cart_add,
            data: {
                product_id: product_id,
                quantity: quantity,
                options: options
            },
            success: function (results) {
                if (results.status == 1) {
                    data['status'] = 1;
                    data['message'] = results.message;
                } else {
                    data['status'] = 0;
                    data['message'] = results.message;
                }
            },
            error: function () {
                data['status'] = 0;
                data['message'] = 'Ürün Sepete Eklenemedi';
            }
        });
        return data;
    }

    this.remove = function (product_id) {
        var data = [];
        $.ajax({
            async: false,
            method: "POST",
            url: GC.url.cart_remove,
            data: {
                product_id: product_id,
            },
            success: function (results) {
                if (results.status == 1) {
                    data['status'] = 1;
                    data['message'] = results.message;
                } else {
                    data['status'] = 0;
                    data['message'] = results.message;
                }
            },
            error: function () {
                data['status'] = 0;
                data['message'] = 'Ürün Sepetten Kaldırılamadı';
            }
        });
        return data;
    }

    this.updateMultiple = function (cart) {
        var data = [];
        $.ajax({
            async: false,
            method: "POST",
            url: GC.url.cart_update_multiple,
            data: cart,
            success: function (results) {
                data['status'] = 1;
                data['message'] = '';
                data['results'] = results;
            },
            error: function () {
                data['status'] = 0;
                data['results'] = [];
                data['message'] = 'Ürünler Yenilenemedi!';
            }
        });
        return data;
    }
}

var Cart = new Cart();