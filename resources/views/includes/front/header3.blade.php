<!-- Topbar Start -->
<?php $setting = DB::table('setting')
    ->where('id', '=', '1')
    ->first();
    $header_menu = DB::table('pages')
    ->where('menu_type', '=', 'header')->where('status','=','1')->orderBy('position', 'asc')
    ->get();
$cate = DB::table('categories')->get();
?>
<div class="top-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{ url('/'); }}">
                        <img src="{{env('APP_URL')}}{{$setting->logo}}" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <form class="search" action="{{url('/search');}}">
                    <input type="text" name="text" placeholder="Search">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="col-md-3">
                <div class="user">
                    <!--<div class="dropdown">-->
                    <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account</a>-->
                    <!--    <div class="dropdown-menu">-->
                    <!--        <a href="#" class="dropdown-item">Login</a>-->
                    <!--        <a href="#" class="dropdown-item">Register</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <a href="{{ url('cart'); }}">
                        <div class="cart">
                            <i class="fa fa-cart-plus"></i>
                            <span id="cartValue">{{ Session::has('cart') ? App\Helpers\Cart::qty() : 0 }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Header End -->


<!-- Header Start -->
<div class="header">
    <div class="container">
        <div class="row px-xl-5">

        
        <div class="col-lg-9 col-md-6 col-sm-4 col-4">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav m-auto">
                    @foreach($header_menu as $k=> $v)
                        
                        <a href="
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
                        " class="nav-item nav-link ">{{$v->name}}</a>
                        @endforeach
                    <!--<a href="product-list.html" class="nav-item nav-link">Products</a>-->
                    <!--<div class="nav-item dropdown">-->
                    <!--    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>-->
                    <!--    <div class="dropdown-menu">-->
                    <!--        <a href="product-list.html" class="dropdown-item">Product</a>-->
                    <!--        <a href="product-detail.html" class="dropdown-item">Product Detail</a>-->
                    <!--        <a href="cart.html" class="dropdown-item">Cart</a>-->
                    <!--        <a href="wishlist.html" class="dropdown-item">Wishlist</a>-->
                    <!--        <a href="checkout.html" class="dropdown-item">Checkout</a>-->
                    <!--        <a href="login.html" class="dropdown-item">Login & Register</a>-->
                    <!--        <a href="my-account.html" class="dropdown-item">My Account</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </nav>
        </div>
        
        </div>
    </div>
</div>
<!-- Header End -->