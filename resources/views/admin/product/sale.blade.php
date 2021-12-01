@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>محصولات</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{route('product.create')}}" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت محصول</a>
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
                        <th>نام محصول</th>
                        <th>نام خریدار</th>
                        <th>موبایل  خریدار</th>
                        <th>ایمیل خریدار</th>
                        <th>مبلغ پرداختی</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sale as $key => $item)
                        <tr class="odd gradeX text-center" id="course{{$item->id}}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->seller_name}}</td>
                            <td>{{$item->seller_mobile}}</td>
                            <td>{{$item->seller_email}}</td>
                            <td>{{number_format($item->price)}}</td>
                            <td>@if($item->status == '0')پرداخت نشده@elseif($item->status == '1')پرداخت شده@endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
