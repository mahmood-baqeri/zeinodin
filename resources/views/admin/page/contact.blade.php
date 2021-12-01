@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">ویرایش اطلاعات تماس با ما</div>
                    <div class="panel-body panel_insert">
                        <form id="form1">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <input id="role" type="hidden" value="0">

                            <div class="row">
                                <div class="col-25">
                                    <label>نام وب سایت </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="name_site" value="{{$data->name_site}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>لوگو</label>
                                </div>
                                <div class="col-75">
                                    <div class="file-input-wrapper">
                                        <button class="btn-file-input">انتخاب فایل</button>
                                        <input type="file" id="file" name="file" value="{{$data->logo}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label> طول جغرافیایی <span style="color: red">*</span> </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="length" value="{{$data->length}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label> عرض جغرافیایی <span style="color: red">*</span> </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="width" value="{{$data->width}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>تلگرام  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="telegram" value="{{$data->telegram}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>فیس بوک  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="facebook" value="{{$data->facebook}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>اینستاگرام  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="instagram" value="{{$data->instagram}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>واتس آپ  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="whatsapp" value="{{$data->whatsapp}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>توییتر  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="twitter" value="{{$data->twitter}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>یوتیوب  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="youtube" value="{{$data->youtube}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>آپارات  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="aparat" value="{{$data->aparat}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>لینکدین  </label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="linkedin" value="{{$data->linkedin}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>ایمیل</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="email" value="{{$data->email}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>فکس</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="fax" value="{{$data->fax}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>تلفن ثابت</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="phone" value="{{$data->phone}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label>موبایل</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="mobile" value="{{$data->mobile}}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-25">
                                    <label>آدرس </label>
                                </div>
                                <div class="col-75">
                                    <textarea type="text" id="address" class="ckeditor">{{$data->address}}</textarea>
                                </div>
                            </div>

                            <div class="row" id="btn">
                                <a class="btn insert_form" href="#" onclick="edit_contact()">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection