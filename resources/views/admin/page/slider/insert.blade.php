@extends('layouts.admin.admin')
@section('content_admin')
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ثبت اسلایدر جدید</div>

                    <div class="panel-body panel_insert">
                        <form id="form1">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <div class="row">
                                <div class="col-25">
                                    <label>انتخاب فایل </label>
                                </div>
                                <div class="col-25" id="image_upload">
                                    <label for="file">
                                        <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                        <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="<?= Url('image/page/image.png') ?>" >
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>لینک اسلایدر </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="link" placeholder="لینک به کدام صفحه">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>عنوان </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="title">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>نمایش عنوان بر روی اسلایدر</label>
                                </div>
                                <div class="col-75">
                                    <select id="show">
                                        <option value="0">خیر</option>
                                        <option value="1">بلی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label> توضیحات برای نمایش در صفحه دیگر </label>
                                </div>
                                <div class="col-75">
                                    <textarea id="text" class="ckeditor"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>وضعیت</label>
                                </div>
                                <div class="col-75">
                                    <select id="status">
                                        <option value="0">غیرفعال</option>
                                        <option value="1">فعال</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="btn">
                                <a class="btn insert_form" href="#" onclick="insert_slider()">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                <a class="btn insert_form" href="<?=url('admin/page/slider/index')?>"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
