$(document).on('change', '.change-status', function () {
    let value;
    if($(this).prop('checked') == true){
        value = 1;
    }else{
        value = 0;
    }
    commonAjax('GET', $('#statusChangeURL').val(),'','',{ 'id': $(this).attr('data-id'),'value': value });
});

(function ($) {
    "use strict";
    var oTable;
    $('#search_property').on('change', function () {
        oTable.search($(this).val()).draw();
    })

    oTable = $('#allCommentDataTable').DataTable({
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
            { "data": "name" },
            { "data": "email"},
            { "data": "comment"},
            { "data": "status" },
            // { "data": "action", "class": "text-end" },
        ]
    });
})(jQuery)


