@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ثبت صفحه جدید</div>
                    <div class="panel-body panel_insert">
                        <form id="form1">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>

                            <div class="alert alert-warning"> <b style="color: darkred"> توجه!!! </b>در صورت عدم باز شدن در صفحه ی دیگر در قسمت متن چیزی نوشته نشود.</div>

                            <div id="home" class="tab-pane fade in active">
                                    <input type="hidden" id="user_id" value="{{auth()->user()->id}}">
                                    <div class="col-100" style="padding: 0px">
                                        <div class="col-25 pull-left" id="image_upload">
                                            <label for="file">
                                                <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                                <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="<?= Url('image/page/image.png') ?>" >
                                            </label>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>انتخاب سردسته <span style="color: red">*</span> </label>
                                    </div>
                                    {{ Form::select('menu_id',$menu,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'menu_id']) }}
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

                                <div class="row">
                                    <div class="col-25">
                                        <label>url صفحه</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="url_default">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>لینک دانلود</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="url_file">
                                    </div>
                                </div>

                                    <div class="row">
                                        <div class="col-25">
                                            <label>عنوان</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="title">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label>متن کوتاه</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="text_short">
                                        </div>
                                    </div>


                                    <div class="row editorPhoto">
                                        <div class="col-25">
                                            <label> تصویر برای ویرایشگر متن زیر</label>
                                        </div>
                                        <div class="col-40" style="width: 45% !important;">
                                            <select name="" id="" class="form-control applicationsImgSelector">
                                                @foreach(\App\Images::orderBy('id' , 'desc')->get() as $item)
                                                    <option value="{{asset($item->photo)}}">{{asset($item->photo)}}</option>
                                                @endforeach
                                            </select>

                                            <p class="applicationsImgUrl" style="text-align: left;margin-top: 30px;"></p>
                                        </div>

                                        <div class="col-30" style="width: 32% !important; margin-left: 0;">
                                            <img class="applicationsImgUrl" src="{{asset($item->photo)}}" alt="" height="250" style="border-radius: 5px;width: 100%;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-25">
                                            <label>متن</label>
                                        </div>
                                        <div class="col-75">
                                            <textarea class="ckeditor"  id="text"></textarea>
                                        </div>
                                    </div>
                                </div>
                            <div class="row" id="btn">
                                <a class="btn insert_form" onclick="insert_page()" href="#">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                <a class="btn insert_form" href="<?=url('admin/page/index')?>"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
