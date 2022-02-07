@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ویرایش محصول </div>
                    <div class="panel-body panel_insert">

                        @include('admin.messages')

                        <form class="form" novalidate method="POST" action="{{route('product.update' , $product->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div id="home" class="tab-pane fade in active">

                                <div class="row name">
                                    <div class="col-25">
                                        <label>نام</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="name" value="{{$product->name}}">
                                    </div>
                                </div>

                                <div class="row link">
                                    <div class="col-25">
                                        <label>لینک</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="link" value="{{$product->link}}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>کلید محصول در اسپات پلیر</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="spotKey" value="{{$product->spotKey}}">
                                    </div>
                                </div>


                                <div class="row name">
                                    <div class="col-25">
                                        <label>قیمت</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="number" name="price" value="{{$product->price}}" style="    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    text-align: right;">
                                    </div>
                                </div>
                                <div class="row file">
                                    <div class="col-25">
                                        <label>عکس</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>
                                <div class="row status">
                                    <div class="col-25">
                                        <label>وضعیت</label>
                                    </div>
                                    <div class="col-75">
                                        <select name="status">
                                            <option value="0" @if($product->status == 0) selected @endif>غیرفعال</option>
                                            <option value="1" @if($product->status == 1) selected @endif>فعال</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row category">
                                    <div class="col-25">
                                        <label>انتخاب دسته بندی <span style="color: red">*</span> </label>
                                    </div>
                                    <select name="category_id" id="" class="col-75">
                                        @foreach($categories as $item)
                                            <option value="{{$item->id}}" @if($product->category_id == $item->id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row metaKeywords">
                                    <div class="col-25">
                                        <label>متای کلمات</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="metaKeywords" id="" cols="30" rows="5">{{$product->metaKeywords}}</textarea>
                                    </div>
                                </div>
                                <div class="row metaDescription">
                                    <div class="col-25">
                                        <label>متای توضیحات</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="metaDescription" id="" cols="30" rows="10">{{$product->metaDescription}}</textarea>
                                    </div>
                                </div>
                                <div class="row summer">
                                    <div class="col-25">
                                        <label>خلاصه مطلب</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="summer" id="" cols="30" rows="5">{{$product->summer}}</textarea>
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
                                        <textarea class="ckeditor"  name="description">{{$product->description}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="btn">
                                <button class="btn insert_form" type="submit"> <i class="fa fa-plus"></i> ثبت اطلاعات </button>&nbsp;
                                <a class="btn insert_form" href="{{route('product.index')}}"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
