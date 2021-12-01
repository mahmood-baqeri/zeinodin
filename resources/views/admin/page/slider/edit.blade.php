@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ویرایش اسلایدر</div>

                    <div class="panel-body panel_insert">
                        {!! Form::model($data) !!}
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <div class="row">
                                <div class="col-25">
                                    <label>انتخاب فایل </label>
                                </div>
                                <div class="col-25" id="image_upload">
                                    <?php if ($data->img == 'image.png') $src = url('image/page/'.$data->img); else $src = url('image/page/slider/'.$data->img);?>
                                    <label for="file">
                                        <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                        <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="{{$src}}" >
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>لینک اسلایدر </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="link" value="@if(!empty($data->link)) {{$data->link}}@endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>عنوان </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="title" value="{{$data->title}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>نمایش عنوان بر روی اسلایدر</label>
                                </div>
                                @php $status=\App\Slider::getShow(); @endphp
                                {{ Form::select('show',$status,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'show']) }}
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label> توضیحات برای نمایش در صفحه دیگر </label>
                                </div>
                                <div class="col-75">
                                    <textarea id="text" class="ckeditor">{!! $data->text !!}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>وضعیت</label>
                                </div>
                                @php $status=\App\Slider::getStatus(); @endphp
                                {{ Form::select('status',$status,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'status']) }}
                            </div>


                            <div class="row" id="btn">
                                <a class="btn insert_form" href="#" onclick="edit_slider({{$data->id}})">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                <a class="btn insert_form" href="<?=url('admin/page/slider/index')?>"><i class="fa fa-undo"></i>   بازگشت</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
