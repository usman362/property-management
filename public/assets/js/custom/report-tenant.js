var dt = $('#tenantReportDataTable').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
        url: $('#tenantReportRoute').val(),
        data: function(d) {
            d.year = $('#year').val(),
            d.month = $('#month').val(),
            d.apartment_id = $('#apartment_id').val(),
            d.building_id = $('#building_id').val()
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
        { className: "text-center", targets: [1, 2, 3, 4, 5, 8] },
        { className: "text-end", targets: [6, 7] },
    ],
    columns: [
        { "data": 'DT_RowIndex', "name": 'DT_RowIndex', orderable: false, searchable: false, },
        { "data": "name", "name": "name" },
        { "data": "apartment_name", "name": "apartment_name" },
        { "data": "apartment_number", "name": "apartment_number" },
        { "data": "check_in_date", "name": "check_in_date" },
        { "data": "check_out_date", "name": "check_out_date" },
        { "data": "contract_date", "name": "contract_date" },
        { "data": "monthly_fees", "name": "monthly_fees"  },
        { "data": "deposit_amount", "name": "deposit_amount"  },
        { "data": "deposit_type", "name": "deposit_type"  },
    ]
});

$('#apartment_id').change(function(){
    dt.draw();
});

$('#building_id').change(function(){
    dt.draw();
});

$('#month').change(function(){
    dt.draw();
});

$('#year').keyup(function(){
    dt.draw();
});
