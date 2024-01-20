$('select[name="origin_provinsi"]').on('change', function () {
    let provinsiId = $(this).val();
    if (provinsiId) {
        jQuery.ajax({
            url: '/api/provinsi/' + provinsiId + '/city',
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="city_origin"]').empty();
                $.each(data, function (key, value) {
                    $('select[name="city_origin"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
        $('select[name="city_origin"]').empty();
    }
});