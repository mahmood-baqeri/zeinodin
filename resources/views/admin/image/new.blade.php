@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ثبت تصویر جدید</div>
                    <div class="panel-body panel_insert">

                        @include('admin.messages')

                        <form class="form" novalidate method="POST" action="{{route('image.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div id="home" class="tab-pane fade in active">

                                <div class="row file">
                                    <div class="col-25">
                                        <label>عکس</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="file" name="file[]" multiple>
                                    </div>
                                </div>

                            </div>

                            <div class="row" id="btn">
                                <button class="btn insert_form" type="submit"> <i class="fa fa-plus"></i> ثبت اطلاعات </button>&nbsp;
                                <a class="btn insert_form" href="{{route('image.index')}}"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('admin/cleave.min.js') }}"></script>
@endsection
