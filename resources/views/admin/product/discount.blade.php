@extends('layouts.admin.admin')

@section('ajax')
    <script>
        function checkDuplicateProductDiscountCode() {
            var form_data = new FormData();
            form_data.append('code', $('.productDiscountCode').val());
            $.ajax({
                url: "/api/checkDuplicateProductDiscountCode",
                type: "post",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.status == -1)
                        alert('کد وارد شده تکراری است')
                }
            })
        }
    </script>
@stop


@section('content_admin')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-12" >
                <div class="loader"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">تخفیف محصولات</div>
                    <div class="panel-body panel_insert">

                        <div class="tab-content">
                            <div class="alert alert-danger" style="display:none;"></div>
                            <div class="alert alert-success ok" style="display:none;"></div>
                            <form id="form_discount" >
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-25">
                                            <label>کد تخفیف</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="code" class="productDiscountCode">
                                            <button onclick="checkDuplicateProductDiscountCode()" style=" background: red; color: #fff;padding: 8px; position: absolute; width: 128px;border-radius: 5px;">بررسی تکراری بودن </button>

                                        </div>
                                        <button class="btn insert_form" onclick="randomCode()" type="button" style="margin-top: 5px;margin-bottom: 15px;">کد سیستمی</button>
                                        <script>
                                            function randomCode(){
                                                var length = 7;
                                                var result           = '';
                                                var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                                var charactersLength = characters.length;
                                                for ( var i = 0; i < length; i++ ) {
                                                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                                                }
                                                document.getElementById("code").value = result ;
                                            };
                                        </script>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label>زمان شروع</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="start_date" style="cursor: pointer;" placeholder="2 بار کلیک کنید">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-25">
                                            <label>زمان انقضا</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="end_date" style="cursor: pointer;" placeholder="2 بار کلیک کنید">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-25">
                                            <label>درصد تخفیف</label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="discount">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-25">
                                            <label> تعداد بلیت </label>
                                        </div>
                                        <div class="col-75">
                                            <input type="text" id="count">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-25">
                                            <label> محصول </label>
                                        </div>
                                        <div class="col-75">
                                            <select name="course_id" id="product_id">
                                                @foreach(\App\Product::orderby('id' , 'desc')->get() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="btn">
                                    <a class="btn insert_form" onclick="insert_product_discount()" href="#">  <i class="fa fa-plus"></i>   ثبت اطلاعات </a>&nbsp;
                                </div>
                            </form>

                            <form id="form_edit_discount"></form>
                            <hr>
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap text-center" cellspacing="0" width="100%">
                                    <thead>
                                    <tr class="center">
                                        <th>ردیف</th>
                                        <th>کد </th>
                                        <th>محصول</th>
                                        <th>درصد </th>
                                        <th> شروع</th>
                                        <th>انقضا</th>
                                        <th> بلیت</th>
                                        <th> تعداد استفاده</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody1"><?php $j=1;?>
                                    @foreach($discount as $data)
                                        <tr class="odd gradeX text-center" id="discount{{$data->id}}">
                                            <td><?php echo $j++?></td>
                                            <td>{{$data->code}}</td>
                                            <td>@isset($data->product){{$data->product->name}}@else - @endisset</td>
                                            <td>{{$data->discount}}</td>
                                            <td>{{$data->start_date}}</td>
                                            <td>{{$data->end_date}}</td>
                                            <td>{{$data->count}}</td>
                                            <td>{{$data->use_count}}</td>
                                            <td>
                                                <a onclick="delete_product_discount({{$data->id}})" class="btn btn_admin" title="حذف رکورد"><i class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="{{ url('admin/cleave.min.js') }}"></script>
@endsection
