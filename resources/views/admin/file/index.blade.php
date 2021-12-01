@extends('layouts.admin.admin')
@section('content_admin')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> مدیریت فایل </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="<?=url('admin/file/insert')?>" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت فایل</a>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%">
                    <thead >
                    <tr style="text-align: center">
                        <th class="text-center">ردیف</th>
                        <th class="text-center">تصویر</th>
                        <th class="text-center">نام فایل</th>
                        <th class="text-center">آدرس فایل</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody><?php $i=1?>
                    @foreach($file as $data)
                        <tr class="odd gradeX text-center" id="file{{$data->id}}">
                            <td><?php echo $i++?></td>
                            <td>
                                <img src="<?=url('image/file/'.$data->img)?>" class="img-rounded" style="width: 60px; height: 60px">
                            </td>
                            <td>{{$data->img}}</td>
                            <td><?=url('image/file/'.$data->img)?></td>
                            <td style="padding: 1%">
                                <a onclick="delete_file({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection