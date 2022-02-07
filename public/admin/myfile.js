jQuery(document).ready(function ($) {
    $('.deleteRecordFromTable').on('click', function (event) {
        event.preventDefault();
        var id = $(this).attr('data-deleteId');
        swal({
            title: " ",
            text: 'مطمئنید: رکورد موردنظر حذف گردد.',
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'بله, حذف شود!',
            cancelButtonText: 'خیر, انصراف!',
        }, function () {
            document.getElementById("deleteRecordForm_" + id).submit();
        });
    });

    $('.applicationsImgSelector').on('change', function () {
        $('img.applicationsImgUrl').attr('src', $(this).val());
        $('p.applicationsImgUrl').text($(this).val());
    });
});


var URL = 'https://zeinodin.org/';

// var URL = 'http://127.0.0.1:8000/';

function alert_insert(error, success, reload, image, insert) {
    if (error) {
        $(".loader").hide();
        $('.alert-danger').empty();
        $.each(error, function (key, value) {
            $('.ok').hide();
            $('.alert-danger').show();
            $('.alert-danger').append('<p>- ' + value + '</p>');
        });
    } else if (reload == 1) {
        location.reload();
    } else if (success) {
        $('#btn').hide();
        $(".loader").hide();
        $('.alert-danger').hide();
        var ok = "<p>- رکورد موردنظر ثبت گردید.</p>";
        $('.ok').show();
        $('.ok').html(ok);
        $('#btn').show();
        if (insert == 1) {
            $('#form1')[0].reset();
        }
    }
    if (image != '' && !error) {
        // $('#form1')[0].reset();
        var img = "<label for=\"file\">\n" +
            "<input type=\"file\" name=\"file\" id=\"file\" style=\"display:none;\" onchange=\"readURL(this);\"/>\n" +
            "<img  id=\"blah\" class=\"img-thumbnail img-responsive\" src=" + image + ">\n" +
            "</label>";
        $('#image_upload').html(img);
    }
}

function insert_data(id, dir, items, image, reload) {
    $(".loader").show();
    var form_data = new FormData();
    items.forEach(function (item) {
        form_data.append(item, $("#" + item).val());
        if (item == 'file') {
            if ($("#file").val() != "") {
                var proprty = document.getElementById('file').files[0];
            }
            form_data.append('file', proprty)
        }
        if (item == 'file_edit') {
            if ($("#file_edit").val() != "") {
                var proprty = document.getElementById('file_edit').files[0];
            }
            form_data.append('file_edit', proprty)
        }
        if (item == 'text') {
            var editor = CKEDITOR.instances.text;
            var text = editor.getData();
            form_data.append('text', text)
        }
        if (item == 'address') {
            var editor = CKEDITOR.instances.address;
            var address = editor.getData();
            form_data.append('address', address)
        }
    });
    if (id != '') {
        form_data.append('id', id)
    }
    $.ajax({
        url: URL + "api/admin/" + dir,
        type: "post",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            alert_insert(data.errors, data.success, reload, image)
        }
    })
}

function alert_delete(id, dir, name) {
    swal({
        title: " ",
        text: 'مطمئنید: رکورد موردنظر حذف گردد.',
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'بله, حذف شود!',
        cancelButtonText: 'خیر, انصراف!',
    }, function () {
        $.ajax({
            url: URL + "api/admin/" + dir,
            type: "post",
            data: {'id': id,},
            success: function (data) {
                swal("حذف شد!", "", "success");
                if (name != '') {
                    $("#" + name + id).remove();
                } else if (name == '') {
                    location.reload();
                }
            }
        })
    });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readURLEdit() {
    if (document.getElementById('file_edit').files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah_edit').attr('src', e.target.result);
        };
        reader.readAsDataURL(document.getElementById('file_edit').files[0]);
    }
}


function edit_about() {
    var id = '';
    const dir = 'edit_about';
    const items = ['text', 'file', 'summer'];
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

function edit_guide() {
    var id = '';
    const dir = 'edit_guide';
    const items = ['text', 'file'];
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

function edit_contact() {
    var id = '';
    const dir = 'edit_contact';
    const items = ['name_site', 'file', 'length', 'width', 'telegram', 'facebook',
        'instagram', 'whatsapp', 'linkedin', 'twitter', 'youtube', 'aparat',
        'fax', 'phone', 'mobile', 'email', 'address'];
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

//Customer

function insert_customer() {
    var id = '';
    const dir = 'insert_customer';
    const items = ['title', 'link', 'file'];
    const image = "";
    const reload = 1;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_customer(id) {
    var id = id;
    const dir = 'edit_customer';
    const items = ['title_edit', 'link_edit', 'file_edit'];
    const image = "";
    const reload = 1;
    insert_data(id, dir, items, image, reload);
}

function edit_show_customer(id) {
    var form_data = new FormData();
    form_data.append('id', id);
    $.ajax({
        url: URL + "api/admin/edit_show_customer",
        type: "post",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $("#form_customer").hide();
            $("#form_edit_customer").show();
            $("#form_edit_customer").html(data);
        }
    });
}

function delete_customer(id) {
    var dir = "delete_customer";
    var name = 'customer';
    alert_delete(id, dir, name);
}

function insert_user_about() {
    var id = '';
    const dir = 'insert_user_about';
    const items = ['name', 'title', 'status' ,'detail', 'file'];
    const image = "";
    const reload = 1;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_user_about(id) {
    var id = id;
    const dir = 'edit_user_about';
    const items = ['name_edit', 'title_edit', 'detail_edit', 'file_edit'];
    const image = "";
    const reload = 1;
    insert_data(id, dir, items, image, reload);
}

function edit_show_user_about(id) {
    var form_data = new FormData();
    form_data.append('id', id);
    $.ajax({
        url: URL + "api/admin/edit_show_user_about",
        type: "post",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            $("#form_about").hide();
            $("#form_edit_about").show();
            $("#form_edit_about").html(data);
        }
    });
}

function delete_user_about(id) {
    var dir = "delete_user_about";
    var name = 'about';
    alert_delete(id, dir, name);
}

function insert_menu() {
    var id = '';
    const dir = 'insert_menu';
    const items = ['parent_id', 'name', 'file'];
    const reload = 1;
    const image = "";
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_show_menu() {
    var menu_id = $("#menu_id").val();
    $.ajax({
        url: URL + "api/admin/edit_show_menu",
        type: "post",
        data: {
            'menu_id': menu_id,
        },
        success: function (data) {
            if (data.success) {
                $("#body_cat").show();
                $("#body_cat").html(data.success);

            } else if (data.error) {
                $("#body_cat").hide();
                $("#body_cat").hide();
            }
        }
    });
}

function edit_menu(id) {
    var id = id;
    const dir = 'edit_menu';
    const items = ['parent_id_edit', 'name_edit', 'file_edit'];
    const reload = 1;
    const image = "";
    insert_data(id, dir, items, image, reload);
}

function delete_menu() {
    var id = $("#id_menu").val();
    var dir = "delete_menu";
    var name = '';
    alert_delete(id, dir, name);
}

function insert_page() {
    var id = '';
    const dir = 'insert_page';
    const items = ['menu_id', 'user_id', 'title', 'text_short', 'text', 'status', 'file', 'url_default', 'url_file'];
    const image = URL + "image/page/image.png";
    const reload = 0;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_page(id) {
    var id = id;
    const dir = 'edit_page';
    const items = ['menu_id', 'user_id', 'title', 'text_short', 'text', 'status', 'file', 'url_default', 'url_file'];
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

function delete_page(id) {
    var dir = "delete_page";
    var name = 'page';
    alert_delete(id, dir, name);
}

function insert_slider() {
    var id = '';
    const dir = 'insert_slider';
    const items = ['link', 'title', 'text', 'show', 'status', 'file'];
    const image = URL + "image/page/image.png";
    const reload = 0;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_slider(id) {
    var id = id;
    const dir = 'edit_slider';
    const items = ['link', 'title', 'text', 'show', 'status', 'file'];
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

function delete_slider(id) {
    var dir = "delete_slider";
    var name = 'slider';
    alert_delete(id, dir, name);
}

function insert_user() {
    var id = '';
    const dir = 'insert_user';
    if ($('#role').val() == '1') {
        var items = ['name', 'last_name', 'gender', 'birthday', 'phone', 'mobile', 'email', 'password', 'text', 'address_user', 'role', 'status', 'file'];
    } else if ($('#role').val() == '2') {
        var items = ['name', 'last_name', 'gender', 'birthday', 'phone', 'mobile', 'email', 'password', 'text', 'address_user', 'category_id', 'type_user', 'role', 'status', 'file'];
    } else if ($('#role').val() == '3') {
        var items = ['name', 'last_name', 'gender', 'birthday', 'phone', 'mobile', 'email', 'password', 'text', 'address_user', 'name_co', 'website', 'role', 'status', 'file'];
    }
    const image = URL + "image/user/image.png";
    const reload = 0;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_user(id) {
    var id = id;
    const dir = 'edit_user';
    if ($('#role').val() == '1') {
        var items = ['name', 'last_name', 'gender', 'birthday', 'phone', 'mobile', 'email', 'password', 'text', 'address_user', 'role', 'status', 'file'];
    } else if ($('#role').val() == '2') {
        var items = ['name', 'last_name', 'gender', 'birthday', 'phone', 'mobile', 'email', 'password', 'text', 'address_user', 'category_id', 'type_user', 'role', 'status', 'file'];
    } else if ($('#role').val() == '3') {
        var items = ['name', 'last_name', 'gender', 'birthday', 'phone', 'mobile', 'email', 'password', 'text', 'address_user', 'name_co', 'website', 'role', 'status', 'file'];
    }
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

function delete_user(id) {
    var dir = "delete_user";
    var name = 'user';
    alert_delete(id, dir, name);
}

function insert_course() {
    var id = '';
    const dir = 'insert_course';
    const items = ['title', 'text_short', 'text', 'user_id', 'price', 'time', 'capacity', 'status', 'date_insert', 'file' ,'spotKey'];
    const image = URL + "image/course/image.png";
    const reload = 0;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_course(id) {
    alert(121212);
    var id = id;
    const dir = 'edit_course';
    const items = ['title', 'text_short', 'text', 'user_id', 'price', 'time', 'capacity', 'status', 'date_insert', 'file' ,'spotKey'];
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

function delete_course(id) {
    var dir = 'delete_course';
    var name = 'course';
    alert_delete(id, dir, name);
}

function insert_site() {
    var id = '';
    const dir = 'insert_site';
    const items = ['title', 'link', 'row_co', 'status', 'file'];
    const image = URL + "image/page/image.png";
    const reload = 0;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function edit_site(id) {
    var id = id;
    const dir = 'edit_site';
    const items = ['title', 'link', 'row_co', 'status', 'file'];
    const image = "";
    const reload = 0;
    insert_data(id, dir, items, image, reload);
}

function delete_site(id) {
    var dir = 'delete_site';
    var name = 'site';
    alert_delete(id, dir, name);
}

function insert_file() {
    var id = '';
    const dir = 'insert_file';
    const items = ['file'];
    const image = '';
    const reload = 0;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function delete_file(id) {
    var dir = 'delete_file';
    var name = 'file';
    alert_delete(id, dir, name);
}


function delete_course_user(id) {
    var dir = "delete_course_user";
    var name = 'course';
    alert_delete(id, dir, name);
}

function delete_contact_form(id) {
    var dir = "delete_contact_form";
    var name = 'contact';
    alert_delete(id, dir, name);
}

function insert_discount() {
    var id = '';
    const dir = 'insert_discount';
    const items = ['code', 'start_date', 'end_date', 'count', 'discount', 'course_id'];
    const image = "";
    const reload = 1;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function delete_discount(id) {
    var dir = "delete_discount";
    var name = 'discount';
    alert_delete(id, dir, name);
}

function insert_product_discount() {
    var id = '';
    const dir = 'product_insert_discount';
    const items = ['code', 'start_date', 'end_date', 'count', 'discount', 'product_id'];
    const image = "";
    const reload = 1;
    const insert = 1;
    insert_data(id, dir, items, image, reload, insert);
}

function delete_product_discount(id) {
    var dir = "product_delete_discount";
    var name = 'discount';
    alert_delete(id, dir, name);
}

let cleave = new Cleave('#price', {
    delimiter: ',',
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});
let cleave1 = new Cleave('#capacity', {
    delimiter: '',
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});

let cleave2 = new Cleave('#discount', {
    delimiter: '',
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});

const sortable = $("#sortTable");
// sortable.sortable({
//     // stop:function (event , ui){
//     //     const paramerts = $sortable.sortable("toArray");
//     //     console.log(paramerts);
//     // }
// });
