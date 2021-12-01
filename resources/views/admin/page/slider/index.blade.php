@extends('layouts.admin.admin')
@section('content_admin')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> مدیریت اسلایدر</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="<?=url('admin/page/slider/insert')?>" class="btn btn_admin_top"><i class="fa fa-plus"></i> ثبت اسلایدر</a>
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
                        <th>تصویر</th>
                        <th>لینک به صفحه</th>
                        <th>وضعیت </th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody><?php $i=1;?>
                    @foreach($slider as $data)
                        <tr class="odd gradeX text-center" id="slider{{$data->id}}">
                            <td><?php echo $i++?></td>
                            <td>
                                <?php if ($data->img == 'image.png') $src = url('image/page/'.$data->img); else $src = url('image/page/slider/'.$data->img);?>
                                <img src="{{$src}}" class="img-rounded" style="width: 60px; height: 60px">
                            </td>

                            <td>
                                @if(empty($data->link)) ندارد
                                @else<a href="{{$data->link}}" target="_blank" class="taga">نمایش</a>@endif
                            </td>
                            <td>
                                @if($data->status==0)غیرفعال
                                @elseif($data->status == 1)فعال
                                @endif
                            </td>
                            <td style="padding: 1%">
                                <a href="<?=url('admin/events/listUser/'.$data->id.'/1')?>" class="btn btn_admin" title="ثبت نام شدگان در این رویداد"><i class="fa fa-list"></i></a>
                                <a href="<?=url('admin/page/slider/edit/'.$data->id)?>" class="btn btn_admin" title="ویرایش اطلاعات"><i class="fa fa-edit"></i></a>
                                <a onclick="delete_slider({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        function delete_slider(id){
            swal({
                title: " ",
                text: 'مطمئنید: رکورد موردنظر حذف گردد.',
                type: "warning",
                showCancelButton: true,
                confirmButtonText: 'بله, حذف شود!',
                cancelButtonText: 'خیر, انصراف!',
            }, function(){
                $.ajax({
                    url: "<?=url('/api/slider/delete_slider')?>",
                    type: "post",
                    data: {
                        'id':id,
                    },
                    success: function (data) {
                        swal("حذف شد!", "", "success");
                        $('#slider'+id).remove();
                    }
                })
            });
        }
    </script>
@endsection
