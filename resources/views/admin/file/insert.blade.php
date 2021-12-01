@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ثبت فایل جدید</div>
                    <div class="panel-body panel_insert">
                        <form id="form1">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <div class="row">
                                <div class="col-25">
                                    <label>انتخاب فایل </label>
                                </div>
                                <div class="col-75">
                                    <div class="file-input-wrapper">
                                        <button class="btn-file-input">انتخاب فایل</button>
                                        <input type="file" id="file" name="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="btn">
                                <a class="btn insert_form" href="#" onclick="insert_file()">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                <a class="btn insert_form" href="<?=url('admin/file/index')?>"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection