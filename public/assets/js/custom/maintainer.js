$(document).on('click', '.add', function () {
    var selector = $('#addMaintainerModal')
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.modal('show');
    selector.find('#addMaintainerModalLabel').html('Add Maintenance');
    selector.find('form').trigger("reset");
    selector.find('#id').val('');
});

$(document).on('click', '.edit', function () {
    commonAjax('GET', $('#getInfoRoute').val(), getDataEditRes, getDataEditRes, { 'id': $(this).data('id') });
});

function getDataEditRes(response) {
    var selector = $('#addMaintainerModal')
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.modal('show');
    selector.find('#addMaintainerModalLabel').html('Edit Maintenance')
    selector.find('#id').val(response.data.id)
    selector.find('#building_name').val(response.data.building_name)
    selector.find('#apartment_number').val(response.data.apartment_number)
    selector.find('#date').val(response.data.date)
    selector.find('#repair_fees').val(response.data.repair_fees)
    selector.find('#utensils_fees').val(response.data.utensils_fees)
    selector.find('#repair_details').val(response.data.repair_details)
    selector.find('#monthly_maintenance_fees').val(response.data.monthly_maintenance_fees)
    let mtypeData = [
        'Plumber',
        'Electric',
        'Structure',
        'Other'
    ];
    let mtype_html = '';
    mtypeData.forEach((unit) => {
        if (unit === response.data.maintenance_type) {
            mtype_html += '<option value="' + unit + '" selected>' + unit + '</option>';
        } else {
            mtype_html += '<option value="' + unit + '">' + unit + '</option>';
        }
    });
    selector.find('#maintenance_type').html(mtype_html);

    let statusData = [
        'Checked In',
        'Checked Out'
    ];
    let status_html = '';
    statusData.forEach((status) => {
        if (status === response.data.status) {
            status_html += '<option value="' + status + '" selected>' + status + '</option>';
        } else {
            status_html += '<option value="' + status + '">' + status + '</option>';
        }
    });
    selector.find('#status').html(status_html);

    let servicesData = [
        'Included',
        'No Included'
    ];
    let services_html = '';
    servicesData.forEach((service) => {
        if (service === response.data.services_included) {
            services_html += '<option value="' + service + '" selected>' + service + '</option>';
        } else {
            services_html += '<option value="' + service + '">' + service + '</option>';
        }
    });
    selector.find('#services_included').html(services_html);
}

(function ($) {
    "use strict";
    var oTable;
    $('#search_property').on('change', function () {
        oTable.search($(this).val()).draw();
    })

    oTable = $('#allMaintainerDataTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        responsive: true,
        ajax: $('#route').val(),
        order: [1, 'desc'],
        ordering: false,
        autoWidth: false,
        drawCallback: function () {
            $(".dataTables_length select").addClass("form-select form-select-sm");
        },
        language: {
            'paginate': {
                'previous': '<span class="iconify" data-icon="icons8:angle-left"></span>',
                'next': '<span class="iconify" data-icon="icons8:angle-right"></span>'
            }
        },
        columns: [
            { "data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false, searchable: false },
            { "data": "building_name" },
            { "data": "apartment_number"},
            { "data": "status" },
            { "data": "maintenance_type"},
            { "data": "date" },
            { "data": "repair_fees"},
            { "data": "utensils_fees" },
            { "data": "monthly_maintenance_fees" },
            { "data": "services_included" },
            { "data": "action", "class": "text-end" },
        ]
    });
})(jQuery)
