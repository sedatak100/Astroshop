var count_row = $('#table-attribute > tbody > tr').length - 1;
$('#table-attribute').on('click', '.btn-new-row', function (e) {
    count_row++;
    e.preventDefault();
    var $clone_row = $('#table-attribute > tbody > tr:first').clone();

    $clone_row.find('[NAME^="attribute"]').each(function (i, e) {
        var new_name = e.name.replace(/^attribute\[(.*?)](.*?)$/i, "attribute[" + count_row + "]$2");
        $(e).prop('name', new_name);
    });

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