@extends('layouts.admin.admin')
@section('content_admin')
    <link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>


    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> مدیریت کاربران </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="<?=url('admin/user/insert/'.$role)?>" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت کاربر</a>
                    {{--@if($role == '2')<a href="<?=url('admin/user/category')?>" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت دسته بندی</a>@endif--}}
                    {{--                    <a href="<?=url('admin/user/admin/level')?>" class="btn btn_admin_top"><i class="fa fa-unlock-alt"></i> تعیین سطح دسترسی</a>--}}
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
                        <th>نام و نام خانوادگی</th>
                        <th>جنسیت</th>
                        <th>تاریخ ثبت نام</th>
                        @if($role == '2')<th>نوع کاربری</th>@endif
                        <th>شماره تماس</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="galley_table"><?php $i=1;?>
                    @foreach($user as $data)
                        <tr id="user{{$data->id}}">
                            <td><?php echo $i++;?></td>
                            <td>{{$data->name}} {{$data->last_name}}</td>
                            <td>{{$data->gender}}</td>
                            <td>{{$data->date}}</td>
                            @if($role == '2')<td>
                                @if($data->type_user==1)مشاور
                                @elseif($data->type_user == 2)مدرس
                                @elseif($data->type_user == 3)مشاور و مدرس
                                @endif</td>@endif
                            <td>{{$data->mobile}}</td>
                            <td>
                                <a href="<?=url('admin/user/edit/'.$data->id.'/'.$role)?>" class="btn btn_admin" title="ویرایش اطلاعات"><i class="fa fa-edit"></i> </a>
                                {{--<a href="<?=url('admin/users/admin/edit_level/'.$data->id)?>" class="btn btn_admin" title=" سطح دسترسی"><i class="fa fa-unlock-alt"></i> </a>--}}
                                <a onclick="delete_user({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{--<script>--}}
        {{--$('#galley_table').sortable();--}}
    {{--</script>--}}
    <script>
        const $sortable = $("#galley_table");
        $sortable.sortable({
            stop:function (event,ui) {
                const parameters=$sortable.sortable("toArray");
                $.ajax({
                    url:'{{ url('api/admin/change_position') }}',
                    type:'POST',
                    data:'position='+parameters,
                    success:function (data) {
                        $("#loading_box").hide();
                    }
                });
            }
        });

    </script>
@endsection
