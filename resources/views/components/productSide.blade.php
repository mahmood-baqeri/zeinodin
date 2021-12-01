<div class="box_1">

    <form action="{{route('product.search')}}" class="search">
        <input type="search" name="text" class="form-control" placeholder="جستجو ... "  @if($text)value="{{$text}}" @endif>

        <input type="hidden" name="min" id="min" @if($min)value="{{$min}}" @endif>
        <input type="hidden" name="max" id="max" @if($max)value="{{$max}}" @endif>
        <input type="hidden" name="sort" id="sort" @if($sort)value="{{$sort}}" @endif>

        <i class="fa fa-search"></i>
    </form>

    <h1>دسته بندی ها : </h1>
    <ul>
        @foreach(\App\ProductCategory::where('status' , 1)->where('parent_id' ,0 )->get() as $item)
            <li><a href="{{route('product.category' , $item->slug)}}">{{$item->name}}</a></li>
            @foreach($item->child as $sumCate)
                <li class="sub">
                    <a href="{{route('product.category' , $sumCate->slug)}}">{{$sumCate->name}}</a>
                </li>
            @endforeach
        @endforeach
    </ul>

    <div class="filterSection a">
        <h5>مرتب سازی : </h5>
        <select name="sort" class="form-control sort">
            <option value="newest" @if($sort == 'newest' ) selected @endif>جدیدترین</option>
            <option value="oldest" @if($sort == 'oldest' ) selected @endif>قدیمی ترین</option>
            <option value="sale" @if($sort == 'sale' ) selected @endif>پرفروش ترین</option>
            <option value="view" @if($sort == 'view' ) selected @endif>پربازدید ترین</option>
        </select>
    </div>

    <div class="filterSection">
        <h5>محدوده قیمت : </h5>
        <ul>
            <li>
                <label for="" class="a">حداقل</label>
                <input type="number" class="min form-control" @if($min)value="{{$min}}" @endif placeholder="حداقل">
            </li>
            <li>
                <label for="" class="b">حداکثر</label>
                <input type="number" class="max form-control" @if($max)value="{{$max}}" @endif placeholder="حداکثر">
            </li>
        </ul>

        <button class="btn btn-success" id="apply"> اعمال</button>
    </div>

</div>



@section('productFilter')
    <script>
        $(document).ready(function () {
            $('.min').on('change' , function () {
                $('#min').val($('.min').val());
            });

            $('.max').on('change' , function () {
                $('#max').val($('.max').val());
            });

            $('.sort').on('change' , function () {
                $('#sort').val($('.sort').val());
                $('form.search').submit();
            });

            $('#apply').on('click' , function () {
                $('form.search').submit();
            });

        });
    </script>
@stop


