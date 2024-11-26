$(document).on('click', '.add', function () {
    var selector = $('#addMaintainerModal')
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.modal('show');
    selector.find('#addMaintainerModalLabel').html('Add Maintenance');
    selector.find('form').trigger("reset");
    selector.find('#id').val('');
});

$(document).on('change', '.change_status', function () {
    commonAjax('GET', $('#status_route').val(), '', '', { 'id': $(this).attr('data-id'),'status': $(this).val() });
});

(function ($) {
    "use strict";
    var oTable;
    $('#search_property').on('change', function () {
        oTable.search($(this).val()).draw();
    })

    oTable = $('#allApplicationDataTable').DataTable({
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
            { "data": "first_name" },
            { "data": "last_name"},
            { "data": "address" },
            { "data": "phone_number"},
            { "data": "check_in_date" },
            { "data": "check_out_date"},
            { "data": "status"},
            // { "data": "action", "class": "text-end" },
        ]
    });
})(jQuery)
