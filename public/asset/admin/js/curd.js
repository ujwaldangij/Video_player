import {
    genaral_funtion
} from "./genaral_funtion.js";
class curd {

    read() {
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
    update = () => {
        $(document).on('click',"#edit_click", function () {
            $('#post_record_edit')[0].reset();
            var id  = $(this).parent().parent().children();
            console.log(id);
            var a = [];
            for (var i = 0 ;i < id.length ; i++){
                a.push(id[i].textContent);
            }
            console.log(a);
            $('#edit_modal_id').val(a[0]);
            $('#edit_modal_title').val(a[1]);
            $('#edit_modal_description').val(a[2]);
            $('#edit_modal_url').val(a[3]);
            $('#edit_modal_old_video').val(a[4]);
            $('#old_frame').attr('src',`uploads/${a[4]}`);
            
        });
    }
}
var obj = new curd();
obj.read();
obj.create();
obj.update();
