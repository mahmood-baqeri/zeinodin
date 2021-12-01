@extends('layouts.admin.admin')
@section('content_admin')
    <div class="clearfix"></div>
    <div class="row col-lg-12">
        <div class="loader"></div>
        <div class="panel panel-default">
            <div class="panel-heading">ثبت کاربر جدید</div>
            <div class="panel-body panel_insert">
                <form id="form1">
                    <div class="alert alert-danger" style="display:none;"></div>
                    <div class="alert alert-success ok" style="display:none;"></div>
                    <input id="role" type="hidden" value="{{$role}}">
                    <div class="col-100" style="padding: 0px">
                        <div class="col-25 pull-left" id="image_upload">
                            <label for="file">
                                <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                <img  id="blah" title="انتخاب عکس" class="img-thumbnail img-responsive" src="<?= Url('image/user/image.png') ?>" >
                            </label>
                        </div>
                        <input type="hidden" id="role" value="{{$role}}">
                        <div class="col-75" style="padding: 0px;margin-top: 10px">
                            <div class="row">
                                <div class="col-25">
                                    <label> نام <span style="color: red">*</span> </label>
                                </div>
                                <div class="col-45">
                                    <input type="text" id="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label> نام خانوادگی <span style="color: red">*</span> </label>
                                </div>
                                <div class="col-45">
                                    <input type="text" id="last_name">
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
                            <input type="text" id="birthday" style="cursor: pointer;" placeholder="2 بار کلیک کنید">
                        </div>
                    </div>
                    @if($role == '2')
                        <div class="row">
                            <div class="col-25">
                                <label>نوع</label>
                            </div>
                            <div class="col-75">
                                <select id="type_user">
                                    <option value="1">مشاور</option>
                                    <option value="2">مدرس</option>
                                    <option value="3">مشاور و مدرس</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>وضعیت</label>
                            </div>
                            <div class="col-75">
                                <select id="category_id">
                                    @foreach($category_user as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    @if($role == '3')
                        <div class="row">
                            <div class="col-25">
                                <label> نام شرکت </label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="name_co">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>وب سایت </label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="website">
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-25">
                            <label> تلفن ثابت </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="phone">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>تلفن همراه <span style="color: red">*</span> </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="mobile" placeholder="09130000000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label> ایمیل</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="email">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>کلمه عبور <span style="color: red">*</span> </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="password" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>وضعیت</label>
                        </div>
                        <div class="col-75">
                            <select id="status">
                                <option value="0">غیرفعال</option>
                                <option value="1">فعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>آدرس</label>
                        </div>
                        <div class="col-75">
                            <textarea  id="address_user"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>جزییات (رزومه)</label>
                        </div>
                        <div class="col-75">
                            <textarea class="ckeditor"  id="text"></textarea>
                        </div>
                    </div>
                    <div class="row" id="btn">
                        <a class="btn insert_form" href="#" onclick="insert_user()">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                        <a class="btn insert_form" href="<?=url('admin/user/index/'.$role)?>"><i class="fa fa-undo"></i>   بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
