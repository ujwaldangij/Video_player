export class genaral_funtion {
    static table = (data) => {
        var html = ``;
        $.each(data, function (indexInArray, valueOfElement) {
            html += `<tr>
                        <th><a href=''>${valueOfElement.id}</a></th>
                        <td>${valueOfElement.title}</td>
                        <td>${valueOfElement.description}</td>
                        <td>${valueOfElement.url}</td>
                        <td>
                        <button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#edit_modal'>Edit</button>
                        <button type='button' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'>Delete</button>
                        </td>
                    </tr>`
        });
        $('#table').html(html);
    }
    static error_clear = (data) => {
        $('.error').remove();
    }
    static error_handler = (data) => {
        this.error_clear();
        $.each(data.responseJSON, function (indexInArray, valueOfElement) {
            console.log(valueOfElement);
            $(`#${indexInArray}`).after(`<div class='error text-danger fw-bold'>${valueOfElement}</div>`);
        });
    }
    static add_record = (data) => {
        this.error_clear();
        $('#post_add_form')[0].reset();
        $('#add_record').modal('hide');
        this.table(data);
    }
}
