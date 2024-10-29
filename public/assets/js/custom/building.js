var thisStateSelector;
$(document).on('change', '.property_id', function () {
    thisStateSelector = $(this).closest('.modal');
    getUnitsByPropertyId();
});

function getUnitsByPropertyId() {
    var selected = thisStateSelector.find('.property_id :selected');
    var units = selected.data("units");
    var optionsHtml = units.map(function (opt) {
        return '<option value="' + opt.id + '">' + opt.unit_name + '</option>';
    }).join('');
    var html = '<option value="">--Select Option--</option>' + optionsHtml
    $(thisStateSelector).find('.unitOption').html(html);
}

function typeStoreDataRes(response) {
    var output = '';
    var type = 'error';
    $('.error-message').remove();
    $('.is-invalid').removeClass('is-invalid');
    if (response['status'] == true) {
        output = output + response['message'];
        type = 'success';
        toastr.success(response.message)
        var html = '<option value="">--Select Option--</option>';
        Object.entries(response.data.types).forEach((type) => {
            html += '<option value="' + type[1].id + '">' + type[1].name + '</option>';
        });
        $('#typesOption').html(html);
        $('#addTypeModal').modal('hide');
    } else {
        commonHandler(response)
    }
}

$('#addTypeModal').on('hidden.bs.modal', function () {
    $('#addBuildingModal').modal('show');
});

$('.addBuilding').on('click', function () {
    var selector = $('#addBuildingModal');
    $('#addBuildingModalLabel').text('Add Building');
    selector.find('.id').val('')
    selector.find('.name').val('')
    selector.find('.address').val('')
    selector.modal('show')
})

$(document).on('click', '.edit', function () {
    commonAjax('GET', $(this).data('detailsurl'), getDataEditRes, getDataEditRes, { 'id': $(this).data('id') });
});

function getDataEditRes(response) {
    var selector = $('#addBuildingModal');
    $('#addBuildingModalLabel').text('Edit Building');
    selector.find('.is-invalid').removeClass('is-invalid');
    selector.find('.error-message').remove();
    selector.find('.id').val(response.data.id)
    selector.find('.name').val(response.data.name)
    selector.find('.address').val(response.data.address)
    selector.modal('show')
}

$('#buildingDatatable').DataTable({
    processing: true,
    serverSide: true,
    pageLength: 25,
    responsive: true,
    ajax: $('#buildingIndexRoute').val(),
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
        { "data": "name" },
        { "data": "address" },
        { "data": "action" },
    ]
});
