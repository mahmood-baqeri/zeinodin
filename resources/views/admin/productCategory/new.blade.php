@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ثبت دسته بندی جدید</div>
                    <div class="panel-body panel_insert">

                        @include('admin.messages')

                        <form class="form" novalidate method="POST" action="{{route('productCategory.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div id="home" class="tab-pane fade in active">

                                <div class="row">
                                    <div class="col-25">
                                        <label>نام</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" name="name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>وضعیت</label>
                                    </div>
                                    <div class="col-75">
                                        <select name="status">
                                            <option value="0">غیرفعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>انتخاب شاخه <span style="color: red">*</span> </label>
                                    </div>
                                    <select name="parent_id" id="" class="col-75">
                                        <option value="0">شاخه اصلی</option>
                                        @foreach($category as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="row">
                                    <div class="col-25">
                                        <label>متای کلمات</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="metaKeywords" id="" cols="30" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>متای توضیحات</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="metaDescription" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>


                            </div>

                            <div class="row" id="btn">
                                <button class="btn insert_form" type="submit"> <i class="fa fa-plus"></i> ثبت اطلاعات </button>&nbsp;
                                <a class="btn insert_form" href="{{route('productCategory.index')}}"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('admin/cleave.min.js') }}"></script>
@endsection
