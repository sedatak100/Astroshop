$(function () {

    $('.global-region').each(function (e) {
        var $this = $(this);

        var $country = $this.find('.select-country');
        var $city = $this.find('.select-city');
        var $district = $this.find('.select-district');

        /*
        $country.select2({
            placeholder: GC.lang.choose_country,
            ajax: {
                url: GC.url.region_countries,
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
        */

        $city.select2({
            placeholder: GC.lang.choose_city,
            ajax: {
                url: GC.url.region_cities_by_country,
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
                url: GC.url.region_districts_by_city,
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

        if ($district.data('selected_id')) {
            $.ajax({
                method: "GET",
                url: GC.url.region_district_city_country,
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
        }

        $country.change(function () {
            $city.empty();
            $district.empty();
        });
        $city.change(function () {
            $district.empty();
        });
        $country.trigger('change');

    });

});