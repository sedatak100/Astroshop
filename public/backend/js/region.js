$('#table-scope').on('change', '.select-country', function (e) {
    var $this = $(this);
    var $row = $this.parents('tr');
    var $select_city = $row.find('.select-city');

    $row.find('.select-city').empty();
    $.ajax({
        url: PC.backend_api_region_cities_by_country,
        data: {
            country_id: $this.val()
        },
        success: function (results) {
            if (results.cities !== undefined) {
                $select_city.append(
                    $('<option/>', {
                        text: PC.lang.all,
                        val: 0,
                        selected: ($select_city.data('selected_id') == 0) ? true : false
                    })
                );
                $.each(results.cities, function (i, e) {
                    $select_city.append(
                        $('<option/>', {
                            text: e.name,
                            val: e.id,
                            selected: ($select_city.data('selected_id') == e.id) ? true : false
                        })
                    );
                });
            }
        }
    });
});

$('#table-scope > tbody > tr').each(function (i, e) {
    var $this = $(this);
    $this.find('.select-country').trigger('change');
});

$('#table-scope').on('click', '.btn-new-row', function (e) {
    e.preventDefault();
    var clone_row = $('#table-scope > tbody > tr:first').clone();
    $('#table-scope tbody').append(clone_row);
    clone_row.find('.select-city').data('selected_id', 0);
    clone_row.find('.select-city').empty();
    clone_row.find('.select-country').trigger('change');
});

$('#table-scope').on('click', '.btn-remove-row', function (e) {
    e.preventDefault();
    var total = $('#table-scope > tbody > tr').length;
    if (total > 1) {
        $(this).parents('tr').remove();
    }
});