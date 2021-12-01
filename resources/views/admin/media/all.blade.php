@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel new">
            @include('admin.messages')
            <form class="form" novalidate method="POST" action="{{route('media.store')}}" enctype="multipart/form-data">
                @csrf

                <div id="home" class="tab-pane fade in active">

                    <input type="hidden" name="type" value="{{$type}}">

                    <div class="row">
                        <div class="col-25">
                            <label>توضیح</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="title" style="border: 1px solid;padding: 8px;width: 100%;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>آلبوم</label>
                        </div>
                        <div class="col-75">
                            <select name="category_id" id="" style="border: 1px solid;padding: 8px;width: 100%;">
                                @foreach($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>فایل</label>
                        </div>
                        <div class="col-75">
                            <input type="file" name="file" style="border: 1px solid;padding: 8px;width: 100%;">
                        </div>
                    </div>

                </div>
                <div class="row" id="btn">
                    <button class="btn insert_form" type="submit"><i class="fa fa-plus"></i> ثبت</button>&nbsp;
                </div>
            </form>

        </div>

        <br><br>

        <div class="x_panel">
            <div class="x_title">
                <h2>
                    @if($type == 1) عکس ها
                    @elseif($type == 2)  فیلم ها
                    @elseif($type == 3)سخنرانی ها
                    @else وبینار ها
                    @endif
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive"
                       class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr class="center">
                        <th>ردیف</th>
                        <th>توضیح</th>
                        <th>آلبوم</th>
                        <th>فایل</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($media as $key => $item)
                            <tr class="odd gradeX text-center" id="course{{$key}}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->category->name}}</td>
                                <td><a href="{{asset($item->file)}}">مشاهده</a></td>
                                <td>
                                    <a href="{{route('media.edit', $item->id)}}" class="btn btn_admin" title="ویرایش اطلاعات"><i class="fa fa-edit"></i></a>
                                    <a data-deleteId="{{$key}}" class="btn btn_admin deleteRecordFromTable"
                                       title="حذف رکورد"><i class="fa fa-trash"></i></a>

                                    <form id="deleteRecordForm_{{$key}}"
                                          action="{{route('media.destroy', ['id' => $item->id])}}"
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
