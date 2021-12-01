@extends('layouts.admin.admin')
@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">مشتریان</div>
                    <div class="panel-body panel_insert">

                        <div class="tab-content">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <form id="form_customer" >
                                <div class="col-sm-3">
                                    <div class="pull-left" id="image_upload">
                                        <label for="file">
                                            <input type="file" name="file" id="file" style="display:none;" onchange="readURL(this);"/>
                                            <img  id="blah" class="img-thumbnail img-responsive" src="<?=url('image/page/image.png')?>">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-25">
                                            <label>عنوان<span style="color: red">*</span>  </label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="title">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label>لینک</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="link">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="btn">
                                    <a class="btn insert_form" onclick="insert_customer()" href="#">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                </div>
                            </form>

                            <form id="form_edit_customer"></form>
                            <hr>
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%">
                                    <thead>
                                    <tr class="center">
                                        <th>ردیف</th>
                                        <th>عکس</th>
                                        <th>عنوان</th>
                                        <th>لینک</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody1"><?php $j=1;?>
                                    @foreach($customer as $data)
                                        <tr class="odd gradeX text-center" id="customer{{$data->id}}">
                                            <td><?php echo $j++?></td>
                                            <td><img width='50' height='50' src="@if($data->img == 'image.png')<?=url('image/page/image.png')?>@else <?=url('image/page/customer/'.$data->img)?> @endif"></td>
                                            <td>{{$data->title}}</td>
                                            <td>{{$data->link}}</td>
                                            <td>
                                                <a onclick="edit_show_customer({{$data->id}})" href="#" class="btn btn_admin" title="ویرایش رکورد"><i class="fa fa-edit"></i> </a>
                                                <a onclick="delete_customer({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i> </a>
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
