@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ایجاد وب سایت جدید</div>
                    <div class="panel-body panel_insert">

                        <div class="tab-content">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <form id="form_customer" >
                                <div class="col-100" style="padding: 0px">
                                    <div class="col-25 pull-left" id="image_upload">
                                        <label for="file">
                                            <?php if ($data->img !='image.png') $src=Url('image/page/site/'.$data->img); else  $src=Url('image/page/'.$data->img);?>
                                            <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                            <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="{{$src}}" >
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>عنوان<span style="color: red">*</span>  </label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="title" value="{{$data->title}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>لینک</label>
                                    </div>
                                    <div class="col-75">
                                        <input type="text" id="link" value="{{$data->link}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>تعداد ردیف</label>
                                    </div>
                                    <div class="col-75">
                                        <select id="row_co">
                                            <option class="color_select" value="{{$data->status}}">
                                                @if($data->row_co == '1')یک ردیف
                                                @elseif($data->row_co == '2')دو ردیف
                                                @elseif($data->row_co == '3')سه ردیف
                                                @elseif($data->row_co == '4')چهار ردیف@endif</option>
                                            <option value="1">یک ردیف</option>
                                            <option value="2">دو ردیف</option>
                                            <option value="3">سه ردیف</option>
                                            <option value="4">چهار ردیف</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-25">
                                        <label>وضعیت نمایش</label>
                                    </div>
                                    <div class="col-75">
                                        <select id="status">
                                            <option class="color_select" value="{{$data->status}}">
                                                @if($data->status == '0')غیرفعال
                                                @elseif($data->status == '1')فعال@endif</option>
                                            <option value="0">غیرفعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="btn">
                                    <a class="btn insert_form" onclick="edit_site({{$data->id}})" href="#">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                    <a class="btn insert_form" href="<?=url('admin/page/site/index')?>"><i class="fa fa-undo"></i>   بازگشت</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
