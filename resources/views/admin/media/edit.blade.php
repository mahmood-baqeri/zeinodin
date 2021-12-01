@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">

        <div class="x_panel new">
            @include('admin.messages')
            <form class="form" novalidate method="POST" action="{{route('media.update' , $media->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div id="home" class="tab-pane fade in active">

                    <div class="row">
                        <div class="col-25">
                            <label>توضیح</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="title" style="border: 1px solid;padding: 8px;width: 100%;" value="{{$media->title}}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label>آلبوم</label>
                        </div>
                        <div class="col-75">
                            <select name="category_id" id="" style="border: 1px solid;padding: 8px;width: 100%;">
                                @foreach($category as $item)
                                    <option value="{{$item->id}}" @if($item->id == $media->category_id) selected @endif>{{$item->name}}</option>
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
    </div>
@endsection
