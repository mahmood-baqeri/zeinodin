<div class="col-md-3 left_col hidden-print">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/admin/index')}}" class="site_title"><i class="fa fa-paw"></i>
                <span>سامانه مدیریت</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{url('image/user/'.auth()->user()->img)}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>خوش آمدید,</span>
                <h2>{{auth()->user()->name}} {{auth()->user()->last_name}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{url('/admin/index')}}"><i class="fa fa-home"></i>خانه</a></li>

                    <li><a><i class="fa fa-user"></i> مدیریت کاربران <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/admin/user/index/1')}}">مدیران</a></li>
                            <li><a href="{{url('/admin/user/index/2')}}">مشاوران</a></li>
                            <li><a href="{{url('/admin/user/index/3')}}">عضویت شده</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-sliders"></i> مدیریت رویداد ها <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('admin/events/index')}}">رویداد ها</a></li>
                            <li><a href="{{url('admin/events/discount')}}">مدیریت تخفیف</a></li>
                            <li><a href="{{url('admin/events/listUser/0/all')}}">کاربران ثبت نام شده</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-file"></i> مدیریت فایل <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('admin/file/index')}}">فایل ها</a></li>
                        </ul>
                    </li>
                    <li><a href="{{url('/admin/contactUser')}}"><i class="fa fa-home"></i>درخواست کاربران</a></li>

                    <li><a><i class="fa fa-desktop"></i> تنظیمات صفحات <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{url('/admin/page/slider/index')}}">اسلایدر</a></li>
                            <li><a href="{{url('/admin/page/site/index')}}">مدیریت سایت های دیگر</a></li>
                            <li><a href="{{url('/admin/page/customer')}}">مشتریان و همکاران</a></li>
                            <li><a href="{{url('/admin/page/contact')}}">تماس با ما</a></li>
                            <li><a href="{{url('/admin/page/about')}}">درباره بنیاد</a></li>
                            <li><a href="{{url('/admin/page/vision')}}">چشم انداز</a></li>
                            <li><a href="{{url('/admin/page/statute')}}">اساسنامه</a></li>
                            <li><a href="{{url('/admin/page/mission')}}">مامورت</a></li>
                            <li><a href="{{url('/admin/page/guide')}}"> راهنمای وبینار</a></li>
                            <li><a href="{{url('/admin/page/about_user')}}">لیست اعضا</a></li>
                            <li><a href="{{url('/admin/page/menu')}}">مدیریت منو</a></li>
                            <li><a href="{{url('/admin/page/index')}}">سایر صفحات</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-desktop"></i> تصاویر داخل ویرایشگرها <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('image.index')}}">همه</a></li>
                            <li><a href="{{route('image.create')}}"> جدید</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-desktop"></i> فعالیت های بنیاد <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('works.index')}}">همه</a></li>
                            <li><a href="{{route('works.create')}}"> جدید</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i> اخبار بنیاد <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('boniadNews.index')}}">همه</a></li>
                            <li><a href="{{route('boniadNews.create')}}"> جدید</a></li>
                        </ul>
                    </li>


                    <li><a><i class="fa fa-desktop"></i> محصولات <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('productCategory.index')}}">دسته بندی ها</a></li>
                            <li><a href="{{route('productCategory.create')}}">دسته بندی جدید</a></li>
                            <li><a href="{{route('product.index')}}">همه محصولات</a></li>
                            <li><a href="{{route('product.create')}}">محصول جدید</a></li>
                            <li><a href="{{route('productDiscountShow')}}">مدیریت تخفیف</a></li>
                            <li><a href="{{route('productSale')}}">محصولات فروخته شده</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-desktop"></i> وبلاگ <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('blogCategory.index')}}">دسته بندی ها</a></li>
                            <li><a href="{{route('blogCategory.create')}}">دسته بندی جدید</a></li>
                            <li><a href="{{route('blog.index')}}">همه پست ها</a></li>
                            <li><a href="{{route('blog.create')}}">پست جدید</a></li>
                            <li><a href="{{route('blogComments.index')}}">نظرات</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-desktop"></i> محتوا <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('mediaCategory.index')}}">آلبوم</a></li>
                            <li><a href="{{route('media.index' , 1 )}}">عکس ها</a></li>
                            <li><a href="{{route('media.index' , 2 )}}"> فیلم ها</a></li>
                            <li><a href="{{route('media.index' , 3 )}}"> سخنرانی ها</a></li>
                            <li><a href="{{route('media.index' , 4 )}}"> وبینار ها</a></li>
                        </ul>
                    </li>


                    <li><a><i class="fa fa-desktop"></i> زندگی نامه <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            @if( \App\Biography::where('type',1)->first())
                                <li><a href="{{route('biography.edit' ,  \App\Biography::where('type',1)->first()->id )}}">شرح زندگی</a></li>
                            @else
                                <li><a href="{{route('biography.create' , 1 )}}">شرح زندگی</a></li>
                            @endif

                            @if( \App\Biography::where('type',2)->first())
                                <li><a href="{{route('biography.edit' ,  \App\Biography::where('type',2)->first()->id )}}"> دوران کاری</a></li>
                            @else
                                <li><a href="{{route('biography.create' , 2 )}}">دوران کاری </a></li>
                            @endif

                            @if( \App\Biography::where('type',3)->first())
                                <li><a href="{{route('biography.edit' ,  \App\Biography::where('type',3)->first()->id )}}"> خدمات ماندگار</a></li>
                            @else
                                <li><a href="{{route('biography.create' , 3 )}}">خدمات ماندگار </a></li>
                            @endif

                            @if( \App\Biography::where('type',4)->first())
                                <li><a href="{{route('biography.edit' ,  \App\Biography::where('type',4)->first()->id )}}">افتخارات </a></li>
                            @else
                                <li><a href="{{route('biography.create' , 4 )}}">افتخارات </a></li>
                            @endif

                            @if( \App\Biography::where('type',5)->first())
                                <li><a href="{{route('biography.edit' ,  \App\Biography::where('type',5)->first()->id )}}">کنفرانس ها </a></li>
                            @else
                                <li><a href="{{route('biography.create' , 5 )}}">کنفرانس ها </a></li>
                            @endif

                            @if( \App\Biography::where('type',6)->first())
                                <li><a href="{{route('biography.edit' ,  \App\Biography::where('type',6)->first()->id )}}"> عضویت ها </a></li>
                            @else
                                <li><a href="{{route('biography.create' , 6 )}}">عضویت ها </a></li>
                            @endif

                        </ul>
                    </li>


                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out pull-right"></i> خروج
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="تنظیمات">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="تمام صفحه" onclick="toggleFullScreen();">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="قفل" class="lock_btn">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="خروج" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

<div class="top_nav hidden-print">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="../build/images/img.jpg" alt="">{{auth()->user()->name}} {{auth()->user()->last_name}}
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;"> ویرایش اطلاعات</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out pull-right"></i> خروج
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
