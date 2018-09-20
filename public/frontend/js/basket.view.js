$(function () {

    $('.product-remove').click(function (e) {
        e.preventDefault();

        var $this = $(this);
        var product_id = $this.data('product_id');

        if (product_id < 1) {
            $.growl.notice({message: "Ürün Bulunamadı"});
        } else {
            var response = Cart.remove(product_id);
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

    $('.form-updated-btn').click(function (e) {
        $('FORM[NAME="updated"]').submit();
    });

});