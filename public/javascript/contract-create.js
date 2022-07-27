$(document).ready(function() {
    let service_id = $('#service_id').find(':selected').text()

    if (service_id == 'Gudang') {
        $('#warehouse_id').show();
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').hide();
        $('#teks').val(null);
    } else if (service_id == 'Depo Container') {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').show();
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').hide();
        $('#teks').val(null);
    } else if (service_id == 'Collateral Management Service (CMS)') {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').show();
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').hide();
        $('#teks').val(null);
    } else if (service_id == 'Logistik') {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').show();
        $('#teks').hide();
        $('#teks').val(null);
    }else {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').show();
    }

    let warehouse_id = $('#warehouse_id').find(':selected').text()
    let depo_id = $('#depo_id').find(':selected').text()
    let c_m_s_id = $('#c_m_s_id').find(':selected').text()
    let logistic_id = $('#logistic_id').find(':selected').text()

    if (warehouse_id == 'Lainnya') {
        $('#lainnya').show();
    } else if (depo_id == 'Lainnya') {
        $('#lainnya').show();
    } else if (c_m_s_id == 'Lainnya') {
        $('#lainnya').show();
    } else if (logistic_id == 'Lainnya') {
        $('#lainnya').show();
    } else {
        $('#lainnya').hide();
        $('#lainnya').val(null);
    }
});

$('#service_id').change(function(e) {
    e.preventDefault();
    let data = $('#service_id').find(':selected').text()

    if (data == 'Gudang') {
        $('#warehouse_id').show();
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').hide();
        $('#teks').val(null);
    } else if (data == 'Depo Container') {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').show();
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').hide();
        $('#teks').val(null);
    } else if (data == 'Collateral Management Service (CMS)') {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').show();
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').hide();
        $('#teks').val(null);
    } else if (data == 'Logistik') {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').show();
        $('#teks').hide();
        $('#teks').val(null);
    } else {
        $('#warehouse_id').hide();
        $('#warehouse_id').val(null);
        $('#depo_id').hide();
        $('#depo_id').val(null);
        $('#c_m_s_id').hide();
        $('#c_m_s_id').val(null);
        $('#logistic_id').hide();
        $('#logistic_id').val(null);
        $('#teks').show();
    }
});

$('#warehouse_id').change(function(e) {
    e.preventDefault();
    let data = $('#warehouse_id').find(':selected').text()

    if (data == 'Lainnya') {
        $('#lainnya').show();
    } else {
        $('#lainnya').hide();
        $('#lainnya').val(null);
    }
});
$('#depo_id').change(function(e) {
    e.preventDefault();
    let data = $('#depo_id').find(':selected').text()

    if (data == 'Lainnya') {
        $('#lainnya').show();
    } else {
        $('#lainnya').hide();
        $('#lainnya').val(null);
    }
});
$('#c_m_s_id').change(function(e) {
    e.preventDefault();
    let data = $('#c_m_s_id').find(':selected').text()

    if (data == 'Lainnya') {
        $('#lainnya').show();
    } else {
        $('#lainnya').hide();
        $('#lainnya').val(null);
    }
});
$('#logistic_id').change(function(e) {
    e.preventDefault();
    let data = $('#logistic_id').find(':selected').text()

    if (data == 'Lainnya') {
        $('#lainnya').show();
    } else {
        $('#lainnya').hide();
        $('#lainnya').val(null);
    }
});