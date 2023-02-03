var empty_error_div = () => {
    $('#error_description').html('');
    $('#error_title').html('');
    $('#error_url').html('');
    $('#error_file').html('');
}
$(document).ready(function () {
    $(document).on('click', '#upload', function (e) {
        e.preventDefault();
        var formData1 = new FormData(post_add_form);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/post_add_record",
            data: formData1,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response) {
                    empty_error_div();
                    $('#post_add_form')[0].reset();
                    $('#add_record').modal('hide');
                    location.reload();
                }
            },
            error: function (response) {
                if (response.status === 500) {
                    empty_error_div();
                    if (response.responseJSON['description']) {
                        $('#error_description').html(response.responseJSON['description']);
                    }
                    if (response.responseJSON['title']) {
                        $('#error_title').html(response.responseJSON['title']);
                    }
                    if (response.responseJSON['url']) {
                        $('#error_url').html(response.responseJSON['url']);
                    }
                    if (response.responseJSON['file']) {
                        $('#error_file').html(response.responseJSON['file']);
                    }
                } else {
                    alert(response.responseJSON);
                }
            }
        });
    });
});
