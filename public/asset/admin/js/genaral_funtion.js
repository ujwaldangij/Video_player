export var table = (data) => {
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
export var error_clear =(data) =>{
    $('.error').remove();
}
export var error_handler = (data) => {
    error_clear();
    $.each(data.responseJSON, function (indexInArray, valueOfElement) {
        console.log(valueOfElement);
        $(`#${indexInArray}`).after(`<div class='error text-danger fw-bold'>${valueOfElement}</div>`);
    });
}
export var add_record = (data) =>{
    error_clear();
    $('#post_add_form')[0].reset();
    $('#add_record').modal('hide');
    table(data);
}
