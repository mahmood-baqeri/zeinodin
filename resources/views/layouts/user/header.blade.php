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
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">درباره ما</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="{{url('/about')}}">درباره بنیاد</a>
                            <a class="dropdown-item" href="{{url('/vision')}}">چشم انداز</a>
                            <a class="dropdown-item" href="{{url('/mission')}}">ماموریت</a>
                            <a class="dropdown-item" href="{{url('/team')}}">اعضا</a>
                            <a class="dropdown-item" href="{{url('/statute')}}">اساسنامه</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">فعالیت های بنیاد</a>
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

                    <li style="position: absolute;left: 13.5%;margin-top:3px;"><a href="{{url('contact')}}" style="font-size: 25px;margin: 0;"><i class="fa fa-phone"></i></a></li>
                    <li style="position: absolute;left: 13.5%;margin-top: 45px;"><a href="{{route('search')}}" style="font-size: 25px;margin: 0;"><i class="fa fa-search"></i></a></li>

                </ul>
                <ul class="sina-menu IRANSansWeb webinar" style="background-color: blue; float:left !important; background-color: #07204b; color:#fff">
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
