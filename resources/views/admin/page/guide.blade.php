<!-- @extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">راهنمای وبینار</div>
                    <div class="panel-body panel_insert">
                        <form id="form1">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <input id="role" type="hidden" value="0">
                            <div class="col-100">
                                <div class="col-25 pull-left" id="image_upload">
                                    <label for="file">
                                        <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                        <img  id="blah" style="cursor: pointer;height: 150px;width: 200px" title="انتخاب عکس" class="img-thumbnail img-responsive" src="@if(!empty($data->img))<?= Url('image/page/about/'.$data->img) ?>@endif" >
                                    </label>
                                </div>
                                <div class="col-75 pull-right">
                                    <div class="row">
                                        <div class="col-25">
                                            <label> راهنمای وبینار<span style="color: red">*</span> </label>
                                        </div>
                                        <div class="col-45">
                                            <textarea class="ckeditor" id="text" rows="10">@if(!empty($data->text)){!! $data->text !!}@endif</textarea>
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
                                </div>
                            </div>

                            <div class="row" id="btn">
                                <a class="btn insert_form" href="#" onclick="edit_guide()">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection -->


@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">راهنمای وبینار</div>
                    <div class="panel-body panel_insert">
                        <form id="form1" method="post" action="{{route('admin.pageUpdate' , $data->id)}}" enctype="multipart/form-data">
                            @csrf

                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <input id="role" type="hidden" value="0">

                            <div class="col-100">
                                <div class="col-25 pull-left" id="image_upload">
                                    <label for="file">
                                        <input type="file" name="file" id="file" style="display:none;"/>
                                        <img  id="blah" style="cursor: pointer;height: 150px;width: 200px" title="انتخاب عکس" class="img-thumbnail img-responsive" src="@if(!empty($data->img))<?= Url($data->img) ?>@endif" >
                                    </label>
                                </div>

                                <!-- <div class="col-75 pull-right">
                                    <div class="row">
                                        <div class="col-25">
                                            <label> خلاصه <span style="color: red">*</span> </label>
                                        </div>
                                        <div class="col-45">
                                            <textarea  name="summer" rows="10">@if(!empty($data->summer)){!! $data->summer !!}@endif</textarea>
                                        </div>
                                    </div>
                                </div> -->

                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label> چشم انداز <span style="color: red">*</span> </label>
                                </div>
                                <div class="col-75">
                                    <textarea class="ckeditor" id="text" name="text" rows="10">@if(!empty($data->text)){!! $data->text !!}@endif</textarea>
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


                            <div class="row" id="btn">
                                <button class="btn insert_form" >  <i class="fa fa-plus"></i>   ثبت اطلاعات </button>&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
