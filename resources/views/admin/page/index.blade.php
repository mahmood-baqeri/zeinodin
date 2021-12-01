@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> مدیریت صفحات</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="<?=url('admin/page/insert')?>" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت صفحات</a>
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
                        <th>منو</th>
                        <th>صفحه</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody><?php $i=1;?>
                    @foreach($page as $data)
                        <tr class="odd gradeX text-center" id="page{{$data->id}}">
                            <td><?php echo $i++?></td>
                            <td>{{$data->getCat->name}}</td>
                            <td title="{{$data->title}}">{{limitWord($data->title , 5)}} ...</td>
                            <td>@if($data->status == '0')غیرفعال@elseif($data->status == '1')فعال@endif</td>
                            <td>
                                <a href="<?=url('admin/page/edit/'.$data->id)?>" class="btn btn_admin" title="ویرایش اطلاعات"><i class="fa fa-edit"></i></a>
                                <a onclick="delete_page({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

