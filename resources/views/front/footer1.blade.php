<?php 
use App\Models\Admins\Setting;
use App\Models\Admins\Category;
$pro= Setting::where(['id'=>'1'])->first();
$header_menu = DB::table('pages')
    ->where('menu_type', '=', 'quick_links')->where('status','=','1')->orderBy('position', 'asc')
    ->get();
$cate = Category::limit('6')->get();
?>
<style>
.footer_btm {
    position: fixed;
    bottom: 0;
    display: none;
    z-index: 999;e
    background: #fff;
    width: 100%;
    left: 0;
    margin:0;
    right: 0;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
@media (max-width: 767px){
.footer_btm {
    display: block;
}
.copy_right{
    margin-bottom:70px;
}
}

.footer_btm ul {
    text-align: center;
    padding:0;
    margin:0;
}
.footer_btm ul li {
    display: inline-block;
    width: 23%;
}
.footer_btm ul li a {
    display: inline-block;
    padding: 7px 0;
    font-size: 15px;
}
.footer_btm ul li a svg {
    display: block;
    margin: 0 auto 5px;
}
.product-item .btn:hover {
    color: #32c155 !important;
}

</style>
 <!-- Footer Start -->
    <div class="container-fluid text-white mt-5 pt-5 my_footer">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 text-left col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="/" class="text-decoration-none" title="logo">
                    <h1 class="m-0 display-5 font-weight-semi-bold mb-4"><img alt="" src="{{env('APP_URL')}}{{$pro->wlogo}}" width="230px" height="60px"></h1>
                </a>
                <p class="mb-2"><i class="fa fa-map-marker mr-3"></i>{{$pro->homepage_footer}}</p>
                <p class="mb-2"><i class="fa fa-envelope mr-3"></i>{{$pro->email}}</p>
                <p class="mb-0"><i class="fa fa-phone  mr-3"></i>{{$pro->phone}}</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5 text-left">
                        <h5 class="font-weight-bold text-white mb-4">Quick Links</h5>
                        <div class="d-flex flex-column justify-content-start">
                            @foreach($header_menu as $k=> $v)
                            @if($k <=4)
                        
                        <a class="text-white mb-2" href="
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
                        "><i class="fa fa-angle-right" style="margin-right: 8px;"></i>{{$v->name}}</a>
                        @endif
                        @endforeach
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="font-weight-bold text-white mb-4">Newsletter</h5>
                        <form action="{{url('/subcribe_newsletter')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="name" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control border-0 py-4" placeholder="Your Email"
                                    required="required" />
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block py-3" style="border: 2px solid #fff;" type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4 copy_right">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-white">
                    &copy;copyright 2023 <a class="text-white font-weight-semi-bold" href="/">{{$pro->site_title}}</a>. All Rights Reserved. 
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="https://clickbuy.com.pk/img/payment.png" alt="">
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <ul class="cart-list link-dropdown-list">
                    <table class="table table-image">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Qty</th>
              <th scope="col">Total</th>
              <!--<th scope="col">Actions</th>-->
            </tr>
          </thead>
          <tbody id="cart_data">
             
          </tbody>
        </table> 
                    
                      
                     
                    </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <!-- Footer End -->
    <div class="footer_btm">
  <ul>
    <li>
      <a href="/">
        <svg aria-hidden="true" focusable="false" width="30px" height="30px" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M16 8.414l-4.5-4.5L4.414 11H6v8h3v-6h5v6h3v-8h1.586L17 9.414V6h-1v2.414zM2 12l9.5-9.5L15 6V5h3v4l3 3h-3v7.998h-5v-6h-3v6H5V12H2z" fill="#626262"></path></svg>
        Home
      </a>
    </li>
    <li>
      <a href="#">
        <svg aria-hidden="true" focusable="false" width="30px" height="30px" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M3 8V7h17v1H3zm17 4v1H3v-1h17zM3 17h17v1H3v-1z" fill="#626262"></path></svg>
        Category
      </a>
    </li>
    <li>
      <a href="/search">
        <svg aria-hidden="true" focusable="false" width="30px" height="30px" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M9.5 4a6.5 6.5 0 0 1 4.932 10.734l5.644 5.644l-.707.707l-5.645-5.645A6.5 6.5 0 1 1 9.5 4zm0 1a5.5 5.5 0 1 0 0 11a5.5 5.5 0 0 0 0-11z" fill="#626262"></path></svg>
        Search
      </a>
    </li>
    <li>
      <a href="/cart">
        <svg aria-hidden="true" focusable="false" width="30px" height="30px" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M16 18a2 2 0 1 1 0 4a2 2 0 0 1 0-4zm0 1a1 1 0 1 0 0 2a1 1 0 0 0 0-2zm-9-1a2 2 0 1 1 0 4a2 2 0 0 1 0-4zm0 1a1 1 0 1 0 0 2a1 1 0 0 0 0-2zM18 6H4.273l2.547 6H15a.994.994 0 0 0 .8-.402l3-4h.001A1 1 0 0 0 18 6zm-3 7H6.866L6.1 14.56L6 15a1 1 0 0 0 1 1h11v1H7a2 2 0 0 1-1.75-2.97l.72-1.474L2.338 4H1V3h2l.849 2H18a2 2 0 0 1 1.553 3.26l-2.914 3.886A1.998 1.998 0 0 1 15 13z" fill="#626262"></path></svg>
        Cart
      </a>
    </li>
  </ul>
</div>