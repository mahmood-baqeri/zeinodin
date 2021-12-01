@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> مدیریت ثبت نام کنندگان در دوره ها</h2>
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
                        <th>عنوان رویداد</th>
                        <th>نام و نام خانوادگی</th>
                        <th>شماره تماس</th>
                        <th>ایمیل</th>
                        <th>قیمت</th>
                        <th>تخفیف</th>
                        <th>قیمت نهایی</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody><?php $i=1;?>
                    @foreach($course as $data)
                        <tr class="odd gradeX text-center" id="course{{$data->id}}">
                            <td><?php echo $i++?></td>
                            @if($data->slider_id != Null)
                               <td title="{{$data->getSlider->title}}">{{limitWord($data->getSlider->title , 5)}} ...</td>
                            @elseif($data->course_id != Null)
                               <td title="{{$data->getCourse->title}}">{{limitWord($data->getCourse->title , 5)}} ...</td>
                            @endif
                            <td>{{$data->name}}</td>
                            <td>{{$data->mobile}}</td>
                            <td>{{$data->email}}</td>
                            <td>{{$data->price}}</td>
                            <td>{{$data->discount}}</td>
                            <td>{{$data->discount_price}}</td>
                            <td>@if($data->discount == '100') ثبت رایگان @elseif($data->status == '1')پرداخت شده@else پرداخت نشده @endif</td>
                            <td>
                                <a onclick="delete_course_user({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
