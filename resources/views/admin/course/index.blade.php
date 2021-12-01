@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> مدیریت رویداد ها و کارگاه ها</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="<?=url('admin/events/insert')?>" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت رویداد</a>
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
                        <th>رویداد</th>
                        <th>مدرس</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody><?php $i=1;?>
                    @foreach($course as $data)
                        <tr class="odd gradeX text-center" id="course{{$data->id}}">
                            <td><?php echo $i++?></td>
                            <td>{{$data->title}}</td>
                            <td>{{$data->getUser->name}} {{$data->getUser->last_name}}</td>
                            <td>@if($data->status == '0')غیرفعال@elseif($data->status == '1')فعال@endif</td>
                            <td>
                                <a href="<?=url('admin/events/listUser/'.$data->id.'/0')?>" class="btn btn_admin" title="ثبت نام شدگان در این رویداد"><i class="fa fa-list"></i></a>
                                <a href="<?=url('admin/events/edit/'.$data->id)?>" class="btn btn_admin" title="ویرایش اطلاعات"><i class="fa fa-edit"></i></a>
                                <a onclick="delete_course({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

