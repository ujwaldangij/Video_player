import {
    genaral_funtion
} from "./genaral_funtion.js";
class curd {
    read = () => {
        $.ajax({
            type: "post",
            url: "/load_get_dashboard_table",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                genaral_funtion.table(response);
            },
            error: function (response) {
                alert(response.responseJSON);
            },
        });
    }
    create = () => {
        $(document).ready(function () {
            $(document).on('click', '#upload', function (e) {
                e.preventDefault();
                var formData1 = new FormData(post_add_form);
                $.ajax({
                    type: "post",
                    url: "/post_add_record",
                    data: formData1,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response) {
                            genaral_funtion.error_clear();
                            $('#post_add_form')[0].reset();
                            $('#add_record').modal('hide');
                            var obj = new curd();
                            obj.read();
                        }
                    },
                    error: function (response) {
                        if (response.status === 500) {
                            genaral_funtion.error_handler(response);
                        } else {
                            alert(response.responseJSON);
                        }
                    },
                });
            });
        });
    }
}
var obj = new curd();
obj.read();
obj.create();
