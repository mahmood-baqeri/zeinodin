@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>آلبوم</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{route('mediaCategory.create')}}" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت آلبوم</a>
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
                        <th>نام</th>
                        <th>والد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all as $key => $item)
                        <tr class="odd gradeX text-center" id="course{{$item->id}}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{$item->name}}</td>
                            <td>@if($item->parent()){{$item->parent()->name}}@elseشاخه اصلی@endif</td>

                            <td>
                                <a href="{{route('mediaCategory.edit', $item->id)}}" class="btn btn_admin" title="ویرایش اطلاعات"><i class="fa fa-edit"></i></a>
                                <a data-deleteId="{{$item->id}}" class="btn btn_admin deleteRecordFromTable" title="حذف رکورد"><i class="fa fa-trash"></i></a>

                                <form id="deleteRecordForm_{{$item->id}}"
                                      action="{{route('mediaCategory.destroy', $item->id)}}"
                                      method="post" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
