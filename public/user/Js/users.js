var URL = 'https://zeinodin.org/';
// var URL = 'http://127.0.0.1:8000/';

function alert_user(error , success , IsUser , zarinpal, type) {
    if(error){
        $('.alert-danger').empty();
        $('.alert-success').hide();
        var no = "فیلدهای خالی را تکمیل کنید.";
        $('.alert-danger').show();
        $('.alert-danger').html(no);
    }else if(success){
        $('#btn').hide();
        $('.alert-danger').hide();
        var ok = type+ " شما با موفقیت انجام شد.";
        $('.alert-success').show();
        $('.alert-success').html(ok);
        $('#form1')[0].reset();
        $('#btn').show();
    }else if(IsUser){
        $('#btn').hide();
        $('.alert-danger').hide();
        var ok = "کاربر گرامی شما قبلا در این دوره ثبت نام کرده اید.";
        $('.alert-success').show();
        $('.alert-success').html(ok);
        $('#btn').show();
    }else if(zarinpal){
        window.location.href = 'https://www.zarinpal.com/pg/StartPay/'+zarinpal;
    }
}
function insert_data(dir, items , type) {
    var form_data = new FormData();
    items.forEach(function (item) {
        form_data.append(item , $("#"+item).val());
    });
    $.ajax({
        url: URL+"api/user/"+dir,
        type:"post",
        data:form_data,
        contentType:false,
        cache:false,
        processData : false,
        success:function (data) {
            alert_user(data.errors, data.success , data.IsUser, data.zarinpal, type);
        }
    });
}

function insert_contact_user() {
    const type = 'پیام';
    const dir = 'insert_contact';
    const items = ['email', 'name', 'subject', 'text'];
    insert_data(dir, items, type);
}

function insert_course_user() {
    const type = 'ثبت نام';
    const dir = 'insert_course';
    if ($('#discount').val()){
        var items = ['name', 'mobile', 'email', 'course_id' , 'slider_id' , 'type', 'discount' ,'code'];
    } else{
        var items = ['name', 'mobile', 'email', 'course_id' , 'slider_id' , 'type'];
    }
    insert_data(dir, items ,type);
}

function check_code() {
    var code = $("#code").val();
    var course_id = $("#course_id").val();
    var form_data = new FormData();
    form_data.append('code', code);
    form_data.append('course_id', course_id);
    $.ajax({
        url: URL+"api/user/check_code",
        type:"post",
        data:form_data,
        contentType:false,
        cache:false,
        processData : false,
        success:function (data) {
            if (data.errors){
                $("#show_discount").html('<input type="hidden" value="0" id="discount">کد تخفیف را وارد کنید.');
            } else if(data.success){
                if(data.success == 'exp'){
                    $("#show_discount").html('<input type="hidden" value="0" id="discount"> کد تخفیف  منقضی شده است.');
                }else if(data.success == 'not'){
                    $("#show_discount").html('<input type="hidden" value="0" id="discount"> کد تخفیف موجود نمی باشد.');
                }else if(data.success == 'courseNot'){
                    $("#show_discount").html('<input type="hidden" value="0" id="discount"> کد تخفیف برای این رویداد تعریف نشده');
                }else{
                    $("#show_discount").html('<input type="hidden" value='+data.success+' id="discount"> درصد تخفیف شما: '+data.success+'%');

                }
            }
        }
    });
}
function check_product_discount_code() {
    var code = $("#code").val();
    var course_id = $("#course_id").val();
    var form_data = new FormData();
    form_data.append('code', code);
    form_data.append('course_id', course_id);
    $.ajax({
        url: URL+"api/user/check_code",
        type:"post",
        data:form_data,
        contentType:false,
        cache:false,
        processData : false,
        success:function (data) {
            if (data.errors){
                $("#show_discount").html('<input type="hidden" value="0" id="discount">کد تخفیف را وارد کنید.');
            } else if(data.success){
                if(data.success == 'exp'){
                    $("#show_discount").html('<input type="hidden" value="0" id="discount"> کد تخفیف  منقضی شده است.');
                }else if(data.success == 'not'){
                    $("#show_discount").html('<input type="hidden" value="0" id="discount"> کد تخفیف موجود نمی باشد.');
                }else if(data.success == 'courseNot'){
                    $("#show_discount").html('<input type="hidden" value="0" id="discount"> کد تخفیف برای این رویداد تعریف نشده');
                }else{
                    $("#show_discount").html('<input type="hidden" value='+data.success+' id="discount"> درصد تخفیف شما: '+data.success+'%');

                }
            }
        }
    });
}
