$(function () {
    // Begin: Tab 5 - Attributes
    var attribute_count_row = $('#table-attribute > tbody > tr').length - 1;
    $('#table-attribute').on('click', '.btn-new-row', function (e) {
        attribute_count_row++;
        e.preventDefault();
        var $clone_row = $('#table-attribute > tbody > tr:first').clone();

        $clone_row.find('[NAME^="attribute"]').each(function (i, e) {
            var new_name = e.name.replace(/^attribute\[(.*?)](.*?)$/i, "attribute[" + attribute_count_row + "]$2");
            $(e).prop('name', new_name);
        });

        $clone_row.find('input, select, textarea').removeClass('is-invalid')
        $clone_row.find('.invalid-feedback').remove();

        $clone_row.find('.select2').remove();
        $clone_row.find('select, input, textarea').val('');
        globalSelect2($clone_row.find('.global-select2'));

        $('#table-attribute tbody').append($clone_row);
        $clone_row.find('input[type="text"]').val('');
        $clone_row.find('input[type="hidden"]').val('0');
    });

    $('#table-attribute').on('click', '.btn-remove-row', function (e) {
        e.preventDefault();
        var total = $('#table-attribute > tbody > tr').length;
        if (total > 1) {
            $(this).parents('tr').remove();
        }
    });
    // Endof: Tab 5 - Attributes

    // Begin: Tab 6 - Discounts
    var discount_count_row = $('#table-discount > tbody > tr').length - 1;
    $('#table-discount').on('click', '.btn-new-row', function (e) {
        discount_count_row++;
        e.preventDefault();
        var $clone_row = $('#table-discount > tbody > tr:first').clone();

        $clone_row.find('[NAME^="discount"]').each(function (i, e) {
            var new_name = e.name.replace(/^discount\[(.*?)](.*?)$/i, "discount[" + discount_count_row + "]$2");
            $(e).prop('name', new_name);
        });

        $clone_row.find('input, select, textarea').removeClass('is-invalid')
        $clone_row.find('.invalid-feedback').remove();

        datePickers($clone_row.find('.datepicker'));
        globalSelect2($clone_row.find('.global-select2'));

        $('#table-discount tbody').append($clone_row);
        $clone_row.find('input[type="text"]').val('');
        $clone_row.find('input[type="hidden"]').val('0');
    });

    $('#table-discount').on('click', '.btn-remove-row', function (e) {
        e.preventDefault();
        var total = $('#table-discount > tbody > tr').length;
        if (total > 1) {
            $(this).parents('tr').remove();
        }
    });
    // Endof: Tab 6 - Discounts

    // Begin: Tab 6 - campaigns
    var campaign_count_row = $('#table-campaign > tbody > tr').length - 1;
    $('#table-campaign').on('click', '.btn-new-row', function (e) {
        campaign_count_row++;
        e.preventDefault();
        var $clone_row = $('#table-campaign > tbody > tr:first').clone();

        $clone_row.find('[NAME^="campaign"]').each(function (i, e) {
            var new_name = e.name.replace(/^campaign\[(.*?)](.*?)$/i, "campaign[" + campaign_count_row + "]$2");
            $(e).prop('name', new_name);
        });

        $clone_row.find('input, select, textarea').removeClass('is-invalid')
        $clone_row.find('.invalid-feedback').remove();

        datePickers($clone_row.find('.datepicker'));
        globalSelect2($clone_row.find('.global-select2'));

        $('#table-campaign tbody').append($clone_row);
        $clone_row.find('input[type="text"]').val('');
        $clone_row.find('input[type="hidden"]').val('0');
    });

    $('#table-campaign').on('click', '.btn-remove-row', function (e) {
        e.preventDefault();
        var total = $('#table-campaign > tbody > tr').length;
        if (total > 1) {
            $(this).parents('tr').remove();
        }
    });
    // Endof: Tab 6 - campaigns

    // Begin: Alert Tab Open
    var $is_error = $('#product-tabs').find('.is-invalid:first');
    if($is_error.length){
        $('#product-tabs').find('.active').removeClass('active');
        $('#product-tabs').find('.show').removeClass('show');
        var $tab_pane = $is_error.closest('.tab-pane');

        $tab_pane.addClass('active');
        $tab_pane.addClass('show');
        $tab_id = $tab_pane.prop('id');
        $('#product-tabs').find('a[href$="' + $tab_id + '"]').addClass('active');
        $('#product-tabs').find('a[href$="' + $tab_id + '"]').addClass('show');
    }
    // Endof: Alert Tab Open

});