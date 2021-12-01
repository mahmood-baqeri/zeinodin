@extends('layouts.admin.admin')
@section('content_admin')
    <div class="clearfix"></div>
    <div class="row col-lg-12">
        <div class="loader"></div>
        <div class="panel panel-default">
            <div class="panel-heading">ویرایش اطلاعات کاربر</div>
            <div class="panel-body panel_insert">
                {!! Form::model($data) !!}
                    <div class="alert alert-danger" style="display:none;"></div>
                    <div class="alert alert-success ok" style="display:none;"></div>
                    <input id="role" type="hidden" value="{{$role}}">
                    <div class="col-100" style="padding: 0px">
                        <div class="col-25 pull-left" id="image_upload">
                            <label for="file">
                                <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="<?= Url('image/user/'.$data->img) ?>" >
                            </label>
                        </div>
                        <input type="hidden" id="role" value="{{$role}}">
                        <div class="col-75" style="padding: 0px;margin-top: 10px">
                            <div class="row">
                                <div class="col-25">
                                    <label> نام <span style="color: red">*</span> </label>
                                </div>
                                <div class="col-45">
                                    <input type="text" id="name" value="{{$data->name}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label> نام خانوادگی <span style="color: red">*</span> </label>
                                </div>
                                <div class="col-45">
                                    <input type="text" id="last_name" value="{{$data->last_name}}" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>جنسیت  </label>
                        </div>
                        <div class="col-75">
                            <select id="gender">
                                <option value="مذکر">مذکر</option>
                                <option value="مونث">مونث</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>تاریخ تولد </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="birthday" style="cursor: pointer;" value="{{$data->birthday}}">
                        </div>
                    </div>
                    @if($role == '2')
                        <div class="row">
                            <div class="col-25">
                                <label>وضعیت</label>
                            </div>
                            @php $type=\App\User::getType(); @endphp
                            {{ Form::select('type_user',$type,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'type_user']) }}
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>تخصص</label>
                            </div>
                            {{ Form::select('category_id',$catList,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'category_id']) }}
                        </div>
                    @endif
                    @if($role == '3')
                        <div class="row">
                            <div class="col-25">
                                <label> نام شرکت </label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="name_co" value="{{$data->name_co}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>وب سایت </label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="website" value="{{$data->website}}">
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label> تلفن ثابت </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="phone" value="{{$data->phone}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>تلفن همراه <span style="color: red">*</span> </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="mobile" value="{{$data->mobile}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label> ایمیل</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="email" value="{{$data->email}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>وضعیت</label>
                        </div>
                        @php $status=\App\User::getStatus(); @endphp
                        {{ Form::select('status',$status,null,['class'=>'col-75 selectpicker','data-live-search'=>'true', 'id'=>'status']) }}
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>آدرس</label>
                        </div>
                        <div class="col-75">
                            <textarea  id="address_user">{!! $data->address_user !!}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>جزییات (رزومه)</label>
                        </div>
                        <div class="col-75">
                            <textarea class="ckeditor"  id="text">{!! $data->text !!}</textarea>
                        </div>
                    </div>
                    <div class="row" id="btn">
                        <a class="btn insert_form" href="#" onclick="edit_user({{$data->id}})">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                        <a class="btn insert_form" href="<?=url('admin/user/index/'.$role)?>"><i class="fa fa-undo"></i>   بازگشت</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
