@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">مشاهده و پاسخ </div>
                    <div class="panel-body panel_insert">

                        @include('admin.messages')

                        <form class="form" novalidate method="POST" action="{{route('blogComments.update' , $blogComments->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div id="home" class="tab-pane fade in active">

                                <div class="row">
                                    <div class="col-25">
                                        <label>نظر کاربر</label>
                                    </div>
                                    <div class="col-75">
                                        <p>{{$blogComments->comment}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>وضعیت</label>
                                    </div>
                                    <div class="col-75">
                                        <select name="status">
                                            <option value="0" @if($blogComments->status == 0) selected @endif>غیرفعال</option>
                                            <option value="1" @if($blogComments->status == 1) selected @endif>فعال</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-25">
                                        <label>پاسخ</label>
                                    </div>
                                    <div class="col-75">
                                        <textarea name="adminAnswer" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>


                            </div>

                            <div class="row" id="btn">
                                <button class="btn insert_form" type="submit"> <i class="fa fa-plus"></i> ثبت اطلاعات </button>&nbsp;
                                <a class="btn insert_form" href="{{route('blogComments.index')}}"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('admin/cleave.min.js') }}"></script>
@endsection
