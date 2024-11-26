var dt = $('#maintenanceReportDataTable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
        url: $('#maintenanceReportRoute').val(),
        data: function(d) {
            d.year = $('#year').val(),
            d.month = $('#month').val(),
            d.apartment_id = $('#apartment_id').val()
        }
    },
    order: [1, 'desc'],
    ordering: false,
    autoWidth: false,
    lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, 'All'],
    ],
    drawCallback: function () {
        $(".dataTables_length select").addClass("form-select form-select-sm");
    },
    language: {
        'paginate':
        {
            'previous': '<span class="iconify" data-icon="icons8:angle-left"></span>',
            'next': '<span class="iconify" data-icon="icons8:angle-right"></span>'
        }
    },
    dom: '<"row"<"col-xxl-4 col-xl-3 col-md-6"l><"col-xxl-4 col-xl-5 col-md-6"B><"col-xl-4 tenantReportDataTable-search"f>>tr<"bottom"<"row"<"col-sm-6"i><"col-sm-6"p>>><"clear">',
    buttons: [
        { extend: 'excel', className: 'theme-btn theme-button1 default-hover-btn' },
        { extend: 'pdf', className: 'theme-btn theme-button1 default-hover-btn' },
        // { extend: 'copy', className: 'theme-btn theme-button1 default-hover-btn' }
    ],
    columnDefs: [
        { className: "text-center", targets: [1, 2, 3, 4, 5] },
    ],
    columns: [
        { "data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false, searchable: false, },
        { "data": "apartment_name", "name": "apartment_name" },
        { "data": "date", "name": "date" },
        { "data": "maintenance_type", "name": "maintenance_type" },
        { "data": "status", "name": "status" },
        { "data": "repair_fees", "name": "repair_fees" },
    ]
});

$('#apartment_id').change(function(){
    dt.draw();
});

$('#month').change(function(){
    dt.draw();
});

$('#year').keyup(function(){
    dt.draw();
});
