$(function () {

    $('FORM[NAME="cart_add"]').submit(function (e) {
        e.preventDefault();

        var $this = $(this);
        var product_id = $this.find('INPUT[NAME="product_id"]').val();
        var quantity = $this.find('INPUT[NAME="quantity"]').val();

        if (product_id < 1) {
            $.growl.notice({message: "Ürün Bulunamadı"});
        } else if (quantity < 1) {
            $.growl.notice({message: "Lütfen ürün adetini seçiniz"});
        } else {
            var response = Cart.add(product_id, quantity, []);
            console.log(response);
            if (response.status == 1) {
                $.growl({
                    title: "",
                    message: response.message
                });
                location.href = location.href;
            } else {
                $.growl.error({
                    title: "",
                    message: response.message
                });
            }
        }
    });

    $('.now-cart-add').click(function (e) {
        e.preventDefault();

        var $this = $('FORM[NAME="cart_add"]');
        var product_id = $this.find('INPUT[NAME="product_id"]').val();
        var quantity = $this.find('INPUT[NAME="quantity"]').val();

        if (product_id < 1) {
            $.growl.notice({message: "Ürün Bulunamadı"});
        } else if (quantity < 1) {
            $.growl.notice({message: "Lütfen ürün adetini seçiniz"});
        } else {
            var response = Cart.add(product_id, quantity, []);
            if (response.status == 1) {
                $.growl({
                    title: "",
                    message: response.message
                });
                location.href = GC.url.cart_basket_logged;
            } else {
                $.growl.error({
                    title: "",
                    message: response.message
                });
            }
        }
    });

});