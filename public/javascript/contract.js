$(document).ready(function () {
    $('#pilihan').hide();
    $('#teks').hide();
    $('#lainnya').hide();
});

$('#service_id').change(function (e) {
    e.preventDefault();
    let data = $('#service_id').find(':selected').text()

    if (data == 'Gudang') {
        $('#pilihan').val('');
        $('#pilihan').show();
        $('#teks').val('');
        $('#teks').hide();
    } else {
        $('#pilihan').val('');
        $('#pilihan').hide();
        $('#teks').val('');
        $('#teks').show();
    }
});

$('#pilihan').change(function (e) {
    e.preventDefault();
    let data = $('#pilihan').find(':selected').text()

    if (data == 'Lainnya') {
        $('#lainnya').val('');
        $('#lainnya').show();
    } else {
        $('#lainnya').val('');
        $('#lainnya').hide();
    }
});