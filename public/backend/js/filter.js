var count_row = $('#table-filter > tbody > tr').length - 1;
$('#table-filter').on('click', '.btn-new-row', function (e) {
    count_row++;
    e.preventDefault();
    var $clone_row = $('#table-filter > tbody > tr:first').clone();

    $clone_row.find('[NAME^="filter"]').each(function (i, e) {
        var new_name = e.name.replace(/^filter\[(.*?)](.*?)$/i, "filter[" + count_row + "]$2");
        $(e).prop('name', new_name);
    });

    $('#table-filter tbody').append($clone_row);
    $clone_row.find('input[type="text"]').val('');
    $clone_row.find('input[type="hidden"]').val('0');
});

$('#table-filter').on('click', '.btn-remove-row', function (e) {
    e.preventDefault();
    var total = $('#table-filter > tbody > tr').length;
    if (total > 1) {
        $(this).parents('tr').remove();
    }
});