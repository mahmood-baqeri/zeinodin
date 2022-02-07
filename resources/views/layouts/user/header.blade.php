<header class="nav-container">
    <nav class="sina-nav mobile-sidebar navbar-fixed" data-top="60">
        <div class="container">

            <div class="sina-nav-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="sina-brand pl-4" href="{{url('/') }}">
                    <img src="{{url('image/page/contacts/'.$contact_data->logo)}}" class="img-fluid"/>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="sina-menu sina-menu-center IRANSansWeb">
                    <li><a href="{{url('/events')}}"> رویداد ها</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLinkss2" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">اخبار</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkss2">
                            <a class="dropdown-item" href="{{url('/news/اخبار')}}">اخبار نوآوری</a>
                            <a class="dropdown-item" href="{{route('boniadNews')}}">اخبار بنیاد</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">درباره ما</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="{{url('/about')}}">درباره بنیاد</a>
                            <a class="dropdown-item" href="{{url('/vision')}}">چشم انداز</a>
                            <a class="dropdown-item" href="{{url('/mission')}}">ماموریت</a>
                            <a class="dropdown-item" href="{{url('/team')}}">اعضا</a>
                            <a class="dropdown-item" href="{{url('/statute')}}">اساسنامه</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink10" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false">فعالیت های بنیاد</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink10">

                            @foreach(\App\BoniadWorks::latest()->get() as $item)
                                <a class="dropdown-item" href="{{route('work.single' , $item->slug )}}">{{$item->name}}</a>
                            @endforeach

                        </div>
                    </li>

                    <li><a href="{{route('blog')}}">وبلاگ</a></li>
                    <li><a href="{{route('product.all')}}">فروشگاه محتوا</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            زندگی نامه
                        </a>
                        @php $biography = new \App\Biography(); @endphp
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
                            @if( $biography::where('type',1)->first())
                                <a class="dropdown-item" href="{{route('biographyShow' , 'شرح-زندگی' )}}">شرح زندگی</a>
                            @endif
                            @if( $biography::where('type',2)->first())
                                <a class="dropdown-item" href="{{route('biographyShow' , 'دوران-کاری' )}}"> دوران کاری</a>
                            @endif
                            @if( $biography::where('type',3)->first())
                                <a class="dropdown-item" href="{{route('biographyShow' , 'خدمات-ماندگار' )}}">خدمات ماندگار</a>
                            @endif
                            @if( $biography::where('type',4)->first())
                                <a class="dropdown-item" href="{{route('biographyShow' , 'افتخارات' )}}">افتخارات</a>
                            @endif
                            @if( $biography::where('type',5)->first())
                                <a class="dropdown-item" href="{{route('biographyShow' , 'کنفرانس-ها' )}}">کنفرانس ها</a>
                            @endif
                            @if( $biography::where('type',6)->first())
                                <a class="dropdown-item" href="{{route('biographyShow' , 'عضویت-ها' )}}">عضویت ها</a>
                            @endif

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">محتوا</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="{{route('mediaAlbum' ,  'عکس'  )}}">عکس ها</a>
                            <a class="dropdown-item" href="{{route('mediaAlbum' , 'فیلم' )}}">فیلم ها</a>
                            <a class="dropdown-item" href="{{route('mediaAlbum' , 'سخنرانی' )}}">سخنرانی ها</a>
                            <a class="dropdown-item" href="{{route('mediaAlbum' , 'وبینار' )}}">وبینار ها</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown" style="position: relative; right: 10%;">
                        <a class="nav-link dropdown-toggle" id="userAcount" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user())
                                {{Auth::user()->name .' '. Auth::user()->last_name}}
                            @else
                                حساب کاربری
                            @endif
                        </a>
                        <div class="dropdown-menu" aria-labelledby="userAcount">
                            @if(Auth::user())
                                <a class="dropdown-item" href="{{url('user/profile')}}">پروفایل</a>
                                <a class="dropdown-item" href="{{url('user/myCourse')}}">رویدادهای من</a>
                                <a class="dropdown-item" href="{{url('user/myProducts')}}">محصولات من</a>
                                <a class="dropdown-item" href="{{url('user/logout')}}">خروج</a>
                            @else
                                <a style="cursor: pointer" class="dropdown-item" data-toggle="modal" data-target="#loginModal"> ورود </a>
                                <a style="cursor: pointer" class="dropdown-item" data-toggle="modal" data-target="#registerModal"> عضویت </a>
                            @endif
                        </div>
                    </li>

                    <li style="position: absolute;left: 13.5%;margin-top:3px;"><a href="{{url('contact')}}" style="font-size: 25px;margin: 0;">
                            <i class="fa fa-phone"></i></a></li>
                    <li style="position: absolute;left: 13.5%;margin-top: 45px;"><a href="{{route('search')}}" style="font-size: 25px;margin: 0;">
                            <i class="fa fa-search"></i></a></li>

                </ul>
                <ul class="sina-menu IRANSansWeb webinar"
                    style="background-color: blue; float:left !important; background-color: #07204b; color:#fff">
                    <li>
                        <a href="https://zeinoddiinn.baclass.org/b/73q-5ac-ov0-hal" target='_blank'>ورود به وبینار </a>
                    </li>

                    <li>
                        <a href="https://moshaveroom.ir/" target='_blank'> ورود به سامانه مشاوروم </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php
function first_menu($id)
{
    $sub_cat = \App\Menu::where('parent_id', $id)->first();
    return $sub_cat;
}
?>


<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">عضویت در سایت</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('user/register')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="نام">
                    </div>

                    <div class="form-group">
                        <label for="last_name">نام خانوادگی</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="نام خانوادگی">
                    </div>

                    <div class="form-group">
                        <label for="mobile">تلفن همراه</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" placeholder="تلفن همراه">
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ایمیل">
                    </div>
                    <div class="form-group">
                        <label for="password">رمز عبور</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ml-1">عضویت</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">ورود</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('user/authentication')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ایمیل">
                    </div>
                    <div class="form-group">
                        <label for="password">رمز عبور</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary ml-1">ورود</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; left: 10px;z-index: 1000;">
                <span aria-hidden="true" style="color: red; font-size: 20px;">&times;</span>
            </button>

            <div class="modal-body bg-success"></div>

        </div>
    </div>
</div>
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModallLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; left: 10px;z-index: 1000;">
                <span aria-hidden="true" style="color: #ffffff; font-size: 20px;">&times;</span>
            </button>

            <div class="modal-body bg-danger"></div>


        </div>
    </div>
</div>



@push('js-section')
    <script>
        // $(window).load(function () {
        @if (session('modalActived'))
        $('#{{ session('modalActived') }}').modal('show');
        @endif

        @if (session('success'))
        $('#successModal').modal('show');
        $("<p class='text-white'>{{ session()->get('success') }}</p>").appendTo('#successModal .modal-body');
        @endif

        @if (session('error'))
        $('#errorModal').modal('show');
        $("<p class='text-white'>{{ session()->get('error') }}</p>").appendTo('#errorModal .modal-body');
        @endif


        @if ($errors->any())
        $('#errorModal').modal('show');
        @foreach ($errors->all() as $error)
        $("<p class='text-white'>{{$error }}</p>").appendTo('#errorModal .modal-body');
        @endforeach
        @endif

        $('#registerInEvent').on('click', function () {
            $("#myModal").modal('toggle');
        })

        // });
    </script>
@endpush

