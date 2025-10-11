
<!-- Topbar Start -->
<?php $setting = DB::table('setting')
            ->where('id', '=', '1')
            ->first();
            $cate = DB::table('categories')->get();
            $header_menu = DB::table('pages')
    ->where('menu_type', '=', 'header')->where('status','=','1')->orderBy('position', 'asc')
    ->get();
            ?>
<div class="nav">
            <div class="container">
                <div class="inside-nav">
                    <div class="marquee">
                       <p>Welcome To AyanStore.PK | we offer Free Delivery over purchase of Rs. 5000 all over Pakistan.</p>
                    </div>
                    <div class="nav-col-right">
                        <ul>
                            @if(isset($setting->whatsapp) && !empty($setting->whatsapp))
                            <li> <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank"> <i class="fa-brands fa-whatsapp"></i> {{ $setting->whatsapp }} </a> </li>
                            @endif
                            @if(isset($setting->track_order_link) && !empty($setting->track_order_link) && $setting->track_order_link != '#')
                            <li> <a href="{{ $setting->track_order_link }}" target="_blank"> Track Order </a> </li>
                            @endif
                            @if(isset($setting->about_us_link) && !empty($setting->about_us_link) && $setting->about_us_link != '#')
                            <li> <a href="{{ $setting->about_us_link }}" target="_blank"> About Us </a> </li>
                            @endif
                            @if(isset($setting->contact_us_link) && !empty($setting->contact_us_link) && $setting->contact_us_link != '#')
                            <li> <a href="{{ $setting->contact_us_link }}" target="_blank"> Contact Us </a> </li>
                            @endif
                        </ul>
                    </div>
                </div><!--inside-nav-->
            </div><!--container-->
        </div><!--nav-->

        <!--header-->        

        <div class="header">
            <div class="container">
                <div class="inside-header">
                    <div class="header-logo">
                        <a href="{{env('APP_URL')}}"> <img src="{{env('IMG_URL')}}{{$setting->logo}}" alt="logo"></a>
                    </div><!--header-logo-->
                    <div class="header-search">
                        <form action="{{ url('/search') }}" method="GET" id="searchForm">
                            <input type="text" name="q" placeholder="search your products" value="{{ request('q') }}" id="searchInput">
                            <button type="submit" style="display: none;"></button>
                        </form>
                        <i class="fa-solid fa-magnifying-glass" onclick="document.getElementById('searchForm').submit()"></i>
                    </div><!--inside-search-->
                    <div class="header-login-section">
                        <ul>
                            <li> <a href="#"> Sign In or Sign Up <i class="fa-solid fa-chevron-down"></i> <img src="{{ $assets_url }}img/reshot-icon-user-QLCUYJBKM3.svg"></a> </li>
                            <li> <a href="#" onlick="updateCartSidebar()" class="openCart"> My Cart <span class="cart-count">{{ Session::has('cart') ? App\Helpers\Cart::qty() : 0 }}</span><img src="{{ $assets_url }}img/reshot-icon-shopping-cart-WFDT3CVZMJ.svg"></a> </li>
                        </ul>
                    </div>
                </div><!--inside-header-->
            </div><!--container-->
        </div><!--header-->
         
        <!--mobile-header-->

        <div class="mob-header">
            <div class="container">
                <div class="inside-mob-header">
                    <div class="header-mob-menu">
                        <i id="openMenuMobile" class="fa-solid fa-bars"></i>
                    </div><!--header-logo-->
                    <div class="header-mob-logo">
                        <a href="{{env('APP_URL')}}"> <img src="{{env('IMG_URL')}}{{$setting->logo}}" alt="logo"> </a>
                    </div><!--header-logo-->
                    <div class="header-mob-cart">             
                        <a href="#" class="openCart"> <img src="{{ $assets_url }}img/cart-mob.svg"></a>
                    </div><!--inside-search-->
                    <div class="header-mob-search">                
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div><!--inside-search-->
                </div><!--inside-mob-header-->
            </div><!--container-->
        </div><!--mob-header-->

        
        <div id="cartSidebar" class="cart-sidebar">
            <div class="cart-header">
                <h3>Shopping Cart</h3>
                <span id="closeCart">&times;</span>
            </div>
            <div class="cart-content">
                @if(Session::has('cart') && App\Helpers\Cart::qty() > 0)
                    <!-- Cart items will be loaded dynamically here -->
                    <p>{{ App\Helpers\Cart::qty() }} item(s) in cart</p>
                @else
                    <img src="{{ $assets_url }}img/cart-cut-icon.svg">
                    <p>No Products In The Cart.</p>
                @endif
                <button onclick="window.location.href='{{ url('/') }}'"> Return To Shop </button>
            </div>
        </div><!--cart-sidebar-->
        <div id="cartOverlay"></div>


        <!--category-section-top-->

        <div class="category-section-top">
            <div class="container">
                <div class="inside-cat-sec-top">
                    <div class="category-button-top">
                        <button id="openMenuDesktop"><i class="fa-solid fa-align-left"></i> All Categories</button>
                    </div><!--category-button-top-->
                    <div class="cat-sec-menu">
                        <ul>
                            @foreach($header_menu as $k=> $v)
                            <li> <a href="
                                @if($v->route)
                                    <?php
                                    if($v->route == '/')
                                    {
                                    ?>
                                    {{ '/'; }}
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    {{ url(''); }}/{{$v->route}}
                                    <?php
                                    }
                                    ?>
                                    @else
                                    {{ url('/')}}/{{$v->slug}}
                                    @endif
                                ">{{$v->name}}</a> </li>
                            @endforeach
                        </ul>
                    </div><!--cat-sec-menu-->
                </div><!--inside-cat-sec-top-->
            </div><!--container-->
        </div><!--category-section-top-->
        
        <!--sidebar-->

        <div id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <h3>OUR CATEGORIES</h3>
                <span id="closeMenu">&times;</span>
            </div>
            <ul>
                @foreach($cate as $k=> $v)
                <li class="has-submenu">
                    <a href="{{ url('/')}}/{{$v->slug}}">{{$v->name}}</a>
                    <i class="fa-solid fa-caret-down toggle-submenu"></i>
                    @if(isset($v->subcategories) && count($v->subcategories) > 0)
                    <ul class="submenu">
                        @foreach($v->subcategories as $sub)
                        <li><a href="{{ url('/')}}/{{$sub->slug}}">{{$sub->name}}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div><!--sidebar-->
        <div id="overlay"></div>