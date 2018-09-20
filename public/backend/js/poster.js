var count_row = $('#table-poster > tbody > tr').length - 1;
$('#table-poster').on('click', '.btn-new-row', function (e) {
    count_row++;
    e.preventDefault();
    var $clone_row = $('#table-poster > tbody > tr:first').clone();

    $clone_row.find('[NAME^="poster"]').each(function (i, e) {
        var new_name = e.name.replace(/^poster\[(.*?)](.*?)$/i, "poster[" + count_row + "]$2");
        $(e).prop('name', new_name);
    });

    $clone_row.find('input[type="text"]:not(.input-order)').val('');
    $clone_row.find('input[type="hidden"], textarea').val('');
    $clone_row.find('.filemanager-image > .preview').prop('src', '');
    fileManagerImage($clone_row.find('.filemanager-image'));

    $('#table-poster tbody').append($clone_row);
});

$('#table-poster').on('click', '.btn-remove-row', function (e) {
    e.preventDefault();
    var total = $('#table-poster > tbody > tr').length;
    if (total > 1) {
        $(this).parents('tr').remove();
    }
});