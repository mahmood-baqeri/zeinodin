@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> درخواست کاربران</h2>
                <ul class="nav navbar-right panel_toolbox">
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
                        <th>شماره تماس</th>
                        <th>ایمیل</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody><?php $i=1;?>
                    @foreach($contact as $data)
                        <tr class="odd gradeX text-center" id="contact{{$data->id}}">
                            <td><?php echo $i++?></td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->mobile}}</td>
                            <td>{{$data->email}}</td>
                            <td>
                                <a data-toggle="modal" data-target="#{{$data->id}}" class="btn btn_admin" title="جزییات بیشتر"><i class="fa fa-list"></i></a>
                                <a onclick="delete_contact_form({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div id="{{$data->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">درخواست ارسالی {{$data->name}}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>موضوع</p>
                                        <p>{{$data->subject}}</p>
                                        <p>متن</p>
                                        <p>{{$data->text}}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

