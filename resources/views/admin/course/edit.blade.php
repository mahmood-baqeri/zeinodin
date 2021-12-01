@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ثبت رویداد جدید</div>
                    <div class="panel-body panel_insert">
                        {!! Form::model($data) !!}
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <div id="home" class="tab-pane fade in active">
                                <div class="col-100" style="padding: 0px">
                                    <div class="col-25 pull-left" id="image_upload">
                                        <label for="file">
                                            <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                            <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="<?= Url('image/course/'.$data->img) ?>" >
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-25">
                                        <label>وضعیت</label>
                                    </div>
                                    @php $status=\App\Course::getStatus(); @endphp
                                    {{ Form::select('status',$status,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'status']) }}
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>انتخاب مدرس <span style="color: red">*</span> </label>
                                    </div>
                                    {{ Form::select('user_id',$user,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'user_id']) }}
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>عنوان</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="title" value="{{$data->title}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>قیمت</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="price" value="{{$data->price}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>تاریخ ثبت نام </label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="date_insert" style="cursor: pointer;" value="{{$data->date_insert}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>زمان برگزاری</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="time" value="{{$data->time}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>ظرفیت رویداد</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="capacity" value="{{$data->capacity}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>متن کوتاه</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="text_short" value="{{$data->text_short}}">
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
                                        <textarea class="ckeditor"  id="text">{!! $data->text !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="btn">
                                <a class="btn insert_form" onclick="edit_course({{$data->id}})" href="#">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                <a class="btn insert_form" href="<?=url('admin/events/index')?>"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ url('admin/cleave.min.js') }}"></script>
@endsection