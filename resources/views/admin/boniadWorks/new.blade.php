@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ثبت فعالیت جدید</div>
                    <div class="panel-body panel_insert">

                        @include('admin.messages')

                        <form class="form" novalidate method="POST" action="{{route('works.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div id="home" class="tab-pane fade in active">

                                <div class="row name">
                                    <div class="col-25">
                                        <label>نام</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="name" value="{{old('name')}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>متای کلمات</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="metaKeywords" id="" cols="30" rows="5">{{old('metaKeywords')}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>متای توضیحات</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="metaDescription" id="" cols="30" rows="10">{{Request::old('metaDescription')}}</textarea>
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

                                <div class="row description">
                                    <div class="col-25">
                                        <label>متن</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea class="ckeditor"  name="description">{{old('description')}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="btn">
                                <button class="btn insert_form" type="submit"> <i class="fa fa-plus"></i> ثبت اطلاعات </button>&nbsp;
                                <a class="btn insert_form" href="{{route('works.index')}}"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
