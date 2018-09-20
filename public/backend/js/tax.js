var count_row = $('#table-tax-rate > tbody > tr').length - 1;
$('#table-tax-rate').on('click', '.btn-new-row', function (e) {
    count_row++;
    e.preventDefault();
    var $clone_row = $('#table-tax-rate > tbody > tr:first').clone();

    $clone_row.find('[NAME^="rule"]').each(function (i, e) {
        var new_name = e.name.replace(/^rule\[(.*?)](.*?)$/i, "rule[" + count_row + "]$2");
        $(e).prop('name', new_name);
    });

    $('#table-tax-rate tbody').append($clone_row);
    $clone_row.find('input[type="text"]').val('');
    $clone_row.find('input[type="hidden"]').val('0');
});

$('#table-tax-rate').on('click', '.btn-remove-row', function (e) {
    e.preventDefault();
    var total = $('#table-tax-rate > tbody > tr').length;
    if (total > 1) {
        $(this).parents('tr').remove();
    }
});