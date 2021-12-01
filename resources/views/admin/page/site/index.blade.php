@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> مدیریت نمایش سایت های دیگر</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="<?=url('admin/page/site/insert')?>" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت سایت ها</a>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%">
                    <thead>
                    <tr class="center">
                        <th>ردیف</th>
                        <th>عکس</th>
                        <th>عنوان</th>
                        <th>وضعیت نمایش</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="tbody1"><?php $j=1;?>
                    @foreach($site as $data)
                        <tr class="odd gradeX text-center" id="site{{$data->id}}">
                            <td><?php echo $j++?></td>
                            <?php if ($data->img !='image.png') $src=Url('image/page/site/'.$data->img); else  $src=Url('image/page/'.$data->img);?>
                            <td><img width='50' height='50' src="{{$src}}"></td>
                            <td>{{$data->title}}</td>
                            <td>@if($data->status == '0')غیر فعال@elseفعال@endif</td>
                            <td>
                                <a href="<?=url('admin/page/site/edit/'.$data->id)?>" class="btn btn_admin" title="ویرایش اطلاعات"><i class="fa fa-edit"></i></a>
                                <a onclick="delete_site({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

