@extends('layouts.admin.admin')
@section('content_admin')
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-12" >
            <div class="loader"></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    ثبت منوها
                </div>
                <div class="panel-body panel_insert">
                    <div class="alert alert-danger" style="display:none;"></div>
                    <div class="row">
                        <div class="col-25">
                            <label>نام منو <span style="color: red">*</span> </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>انتخاب سردسته <span style="color: red">*</span> </label>
                        </div>
                        {{ Form::select('parent_id',$menu,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'parent_id']) }}
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label> تصویر</label>
                        </div>
                        <div class="col-25">
                            <label for="file">
                                <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="<?= Url('image/page/image.png') ?>">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <a class="btn insert_form" onclick="insert_menu()">  <i class="fa fa-plus"></i>   ثبت </a>&nbsp;
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    ویرایش منو
                </div>
                <div class="panel-body panel_insert">
                    <div class="row">
                        <div class="col-25">
                            <label>انتخاب منو  </label>
                        </div>
                        {{ Form::select('parent_id',$all_menu,null,['onchange'=>'edit_show_menu()', 'class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'menu_id']) }}

                    </div>
                    <div id="body_cat"></div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    حذف منو
                </div>
                <div class="panel-body panel_insert">
                    <div class="alert alert-warning"> <b style="color: darkred"> هشدار!!! </b>در صورت حذف دسته مادر، تمامی زیر منوها و صفحات مربوطه حذف خواهد شد.</div>
                    <div class="row">
                        <div class="col-25">
                            <label>انتخاب سردسته <span style="color: red">*</span> </label>
                        </div>
                        {{ Form::select('parent_id',$all_menu,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'id_menu']) }}
                    </div>
                    <div class="row">
                        <a class="btn insert_form" onclick="delete_menu()"><i class="fa fa-trash"></i>   حذف</a>&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
