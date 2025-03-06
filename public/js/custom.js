$('body').on('click', '.openFormModal', function (e) {
    var m = $(this),
        id = m.attr('id'),
        route = m.data('url');
    form_code = m.data('formcode');
    $('#saveBtn').attr('disabled', false);


    $.ajax({
        method: "GET",
        context: m,
        url: route,

        success: function (response) {
            if (response.html) {
                $('.formContainer').html(response.html);
                $('.modal-title').text(response.title);            

                $('#backendModal').modal('show');
                // var offsetModal = $('#moveableDialog').offset();
                }

            },
      
        beforeSend: function () {
            $('.page-wrapper').addClass('loading');
            $('.overlay').show();
        },
        complete: function () {
            $('.page-wrapper').removeClass('loading');
            $('.overlay').hide();
        }
    })
});

