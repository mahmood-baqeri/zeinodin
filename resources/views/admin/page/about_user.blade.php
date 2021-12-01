@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">لیست اعضا</div>
                    <div class="panel-body panel_insert">

                        <div class="tab-content">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <form id="form_about" >
                                <div class="col-sm-3 pull-left">
                                    <div class="pull-left" id="image_upload">
                                        <label for="file">
                                            <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                            <img  id="blah" class="img-thumbnail img-responsive" src="<?=url('image/page/image.png')?>">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-9 pull-right">
                                    <div class="row">
                                        <div class="col-25">
                                            <label>نام و نام خانوادگی<span style="color: red">*</span>  </label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label>عنوان شغلی<span style="color: red">*</span>  </label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="title">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-25">
                                            <label>جایگاه</label>
                                        </div>
                                        <div class="col-75">
                                            <select name="status" id="status">
                                                <option value="0">هئیت امنا</option>
                                                <option value="1">تیم اجرایی</option>
                                                <option value="2">مدیر اجرایی</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label>رزومه</label>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="detail"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="btn">
                                    <a class="btn insert_form" onclick="insert_user_about()" href="#">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                </div>
                            </form>

                            <form id="form_edit_about"></form>
                            <hr>
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%">
                                    <thead>
                                    <tr class="center">
                                        <th>ردیف</th>
                                        <th>عکس</th>
                                        <th>عنوان</th>
                                        <th>&#1593;&#1606;&#1608;&#1575;&#1606; &#1588;&#1594;&#1604;&#1740;</th>
                                        <th>جزییات</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody1"><?php $j=1;?>
                                    @foreach($about_user as $data)
                                        <tr class="odd gradeX text-center" id="about{{$data->id}}">
                                            <td><?php echo $j++?></td>
                                            <td><img width='50' height='50' src="@if($data->img == 'image.png')<?=url('image/page/image.png')?>@else <?=url('image/page/about/'.$data->img)?> @endif"></td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->title}}</td>
                                            <td title="{{$data->detail}}">{{limitWord($data->detail , 5)}} ...</td>
                                            <td>
                                                <a onclick="edit_show_user_about({{$data->id}})" href="#" class="btn btn_admin" title="ویرایش رکورد"><i class="fa fa-edit"></i> </a>
                                                <a onclick="delete_user_about({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
