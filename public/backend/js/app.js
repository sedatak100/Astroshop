// Global Select2
var globalSelect2 = function ($this) {
    var url = $this.data('url');
    var $selected = $this.data('selected');
    var multiple = $this.prop('multiple');

    $this.select2({
        allowClear: multiple ? true : false,
        ajax: {
            url: url,
            data: function (params) {

                var query = {
                    term: params.term,
                }
                return query;
            },
            processResults: function (data) {
                if (!multiple) {
                    data.unshift({
                        id: 0,
                        name: 'Seçiniz',
                    });
                }
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                };
            }
        }
    });

    if (!multiple) {
        $this.append(
            $('<option/>', {
                selected: true,
                text: 'Seçiniz',
                value: 0
            })
        );
    }


    if ($selected != '' && $selected !== null && $selected !== undefined) {

        try {
            $selected = [$.parseJSON($selected)];
        } catch (e) {
        }

        $.each($selected, function (i, e) {
            $this.append(
                $('<option/>', {
                    selected: true,
                    text: '',
                    value: e
                })
            );
        });

        $.ajax({
            //async: false,
            method: "GET",
            url: url,
            data: {id: $selected},
            success: function (results) {
                $this.html('');
                if (multiple) {
                    $.each(results, function (i, e) {
                        $this.append(
                            $('<option/>', {
                                selected: true,
                                text: e.name,
                                value: e.id
                            })
                        );
                    });
                } else {
                    $this.append(
                        $('<option/>', {
                            selected: true,
                            text: results[0].name,
                            value: results[0].id
                        })
                    );
                }
            }
        });
    }

    $this.on("select2:select select2:unselecting", function (e) {
        console.log('TEST');
    });
}

// Filemaneger Function
// File Manager
var FILEMANAGER_PREFIX = 'laravel-filemanager';
var lfm = function (options, cb) {
    var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
    window.open(route_prefix + '?type=' + options.type + '&route=' + options.current_name || 'file', 'FileManager', 'width=900,height=600');
    window.SetUrl = cb;
};
var fileManagerImage = function($this){
    var img_src = $this.find('.preview').prop('src');
    var img_src_attr = $this.find('.preview').attr('src');

    if (img_src_attr == '' || img_src == GC.url.storage_public) {
        $this.find('.preview').prop('src', GC.url.asset + 'backend/img/empty-image.png');
    }
    $this.find('.preview').click(function (e) {
        $this_preview = $(this);
        e.preventDefault();
        lfm({
            type: 'image',
            current_name: GC.current_name,
            prefix: ''
        }, function (url, path) {

            var index_of = path.indexOf('/' + FILEMANAGER_PREFIX);
            if (index_of == 0) {
                path = path.substring(FILEMANAGER_PREFIX.length + 2);
            }

            $this_preview.prop('src', GC.url.storage_public + path);
            $this.find('.imagepath').val(path);
        });
    });
}


// FlatPickr - date
var datePickers = function($this){
    $this.flatpickr({wrap: true})
}

$('.datepicker').each(function () {
    datePickers($(this));
})


$(function () {
    // Menu Page Load Selected
    $('.sidebar-section-nav .is-active').closest('.sidebar-section-nav__item').find('.sidebar-section-nav__link').trigger('click');

    // Global Alert Modal
    $('.btn-remove-alert').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);
        var href = $this.prop('href');
        if (href === undefined) {
            href = $this.data('href');
        }
        var method = $this.data('method');
        var message = $this.data('message');

        if (method === undefined) {
            method = 'POST';
        }

        if (message === undefined) {
            message = "Silme işlemini gerçekleştirmek istiyor musunuz?";
        }

        swal({
            title: "Uyarı!",
            text: message,
            icon: "warning",
            buttons: ['Vazgeç', 'Devam Et']
        }).then(function (confirm) {
            if (confirm) {
                var $remove_form = $('<form/>', {
                    'action': href,
                    'method': method
                }).append(
                    $('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': GC.csrf,
                    })
                );
                $remove_form.appendTo(document.body).submit();
            }
        })
    });

    $('.select2-app').each(function () {
        alert('BURAYI NERDE KULLANDIĞINA BAK');
        //todo: nerede kullanuldığına bak ve açıklama olarak ekle
        var $instance = $(this);
        var params = $instance.data('params');

        var request_data = [];
        if (params != undefined && params != '') {
            var exps = params.split('|');
            $.each(exps, function (i, e) {
                var key_val = e.split(';');
                request_data[key_val[0]] = key_val[1];
            })
        }

        var url = $instance.data('url');

        $(this).select2({
            ajax: {
                url: url,
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    query.push(request_data);
                    return query;
                }
            }
        });
    });

    // Global Country - City - District
    $('.global-region').each(function (e) {
        var $this = $(this);

        var $country = $this.find('.select-country');
        var $city = $this.find('.select-city');
        var $district = $this.find('.select-district');

        $country.select2({
            placeholder: GC.lang.choose_country,
            ajax: {
                url: GC.url.backend_api_region_countries,
                data: function (params) {
                    var query = {
                        term: params.term,
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                            }
                        })
                    };
                }
            }
        });

        $city.select2({
            placeholder: GC.lang.choose_city,
            ajax: {
                url: GC.url.backend_api_region_cities_by_country,
                data: function (params) {
                    var query = {
                        term: params.term,
                        country_id: $country.find('option:selected').val(),
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.cities, function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                            }
                        })
                    };
                },
            }
        });

        $district.select2({
            placeholder: GC.lang.choose_district,
            ajax: {
                url: GC.url.backend_api_region_districts_by_city,
                data: function (params) {
                    var query = {
                        term: params.term,
                        city_id: $city.find('option:selected').val(),
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.districts, function (item) {
                            return {
                                id: item.id,
                                text: item.name,
                            }
                        })
                    };
                },
            }
        });
        $.ajax({
            method: "GET",
            url: GC.url.backend_api_region_district_city_country,
            data: {id: $district.data('selected_id')},
            success: function (results) {
                console.log(results);
                $country.append(
                    $('<option/>', {
                        selected: true,
                        text: results.country.name,
                        value: results.country.id
                    })
                );
                $city.append(
                    $('<option/>', {
                        selected: true,
                        text: results.city.name,
                        value: results.city.id
                    })
                );
                $district.append(
                    $('<option/>', {
                        selected: true,
                        text: results.district.name,
                        value: results.district.id
                    })
                );
            }
        });

        $country.change(function () {
            $city.empty();
            $district.empty();
        });
        $city.change(function () {
            $district.empty();
        });
        $country.trigger('change');

    });

    // FILAMANAGER
    $('.filemanager-image').each(function (i, e) {
        fileManagerImage($(this));
    });

    $(document).on('click', '.filemanager-image .btn-remove', function () {
        var $row = $(this).closest('.filemanager-image');
        $row.find('.imagepath').val('');
        $row.find('.preview').prop('src', GC.url.asset + 'backend/img/empty-image.png');
    });

    $('.filemanager-file').each(function (i, e) {
        var $this = $(this);

        $this.find('.filepath').click(function (e) {
            e.preventDefault();
            lfm({
                type: 'file',
                current_name: GC.current_name,
                prefix: ''
            }, function (url, path) {
                var index_of = path.indexOf('/' + FILEMANAGER_PREFIX);
                if (index_of == 0) {
                    path = path.substring(FILEMANAGER_PREFIX.length + 2);
                }
                $this.find('.filepath').val(path);
            });
        });
    });

    $('.filemanager-file .btn-remove').click(function () {
        var $row = $(this).closest('.filemanager-file');
        $row.find('.filepath').val('');
    });

    $('.global-select2').each(function () {
        globalSelect2($(this));
    });

    // CKeditor init
    $('.ckeditor').each(function () {
        ClassicEditor.create(this).then(editor => {

        }).catch(error => {
            console.log('CKEDITOR NOT UNIT : ' + error);
        });
    });

    $('.write-seo').keyup(function () {
        var val = $(this).val();
        var write_input = $(this).data('seo_id');
        var is_disabled = $('#' + write_input).prop('readonly');
        if(is_disabled){
            $('#' + write_input).val(URLify(val));
        }
    });

    $('.seo-disable-input').click(function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        var $target = $('#' + target);
        if(!$target.attr('readonly')){
            $target.attr('readonly', true);
        }else{
            $target.removeAttr('readonly')
        }
    });
});