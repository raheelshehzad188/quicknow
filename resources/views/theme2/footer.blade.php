
<?php 

use App\Models\Admins\Setting;
use App\Models\Admins\Category;
use App\Models\Admins\Media;
$pro= Setting::where(['id'=>'1'])->first();
$media = Media::get();
$cate = Category::limit('6')->get();
?>
<?php $setting = DB::table('setting') 
    ->where('id', '=', '1')
    ->first();
    $header_menu = DB::table('pages')
    ->where('menu_type', '=', 'quick_links')->where('status','=','1')->orderBy('position', 'asc')
    ->get();
$cate = DB::table('categories')->get();
?>
<div class="footer">
            <div class="footer-border">
                <div class="container">
                    <div class="inside-footer">
                        <div class="footer-image-section">
                            <a href="{{ url('/') }}"> <img src="{{env('IMG_URL')}}{{$setting->wlogo}}" alt="logo"> </a>
                            <ul> 
                                @if($setting->facebook)
                                <li> <a href="{{ $setting->facebook }}"> <i class="fa-brands fa-facebook-f"></i> </a> </li>
                                @endif
                                @if($setting->instagram)
                                <li> <a href="{{ $setting->instagram }}"> <i class="fa-brands fa-instagram"></i> </a> </li>
                                @endif
                                @if($setting->twitter)
                                <li> <a href="{{ $setting->twitter }}"> <i class="fa-brands fa-twitter"></i> </a> </li>
                                @endif
                                @if($setting->tiktok)
                                <li> <a href="{{ $setting->tiktok }}"> <i class="fa-brands fa-tiktok"></i> </a> </li>
                                @endif
                                @if($setting->pinterest)
                                <li> <a href="{{ $setting->pinterest }}"> <i class="fa-brands fa-pinterest"></i> </a> </li>
                                @endif
                            </ul>

                        </div><!--footer-image-section-->
                        <div class="footer-sign-up">
                            <h4> Sign Up For New Products Update </h4> 
                            <form class="form-newsletter" id="subscribe-form" action="{{url('/subcribe_newsletter')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-wraper">
                                    <div class="sign-up-input">
                                        <input type="email" name="email" placeholder="Enter Your Email Address" required>
                                    </div><!--sign-up-input-->
                                    <div class="subscribe-button">
                                        <button type="submit"><i class="fa-solid fa-arrow-right"></i> </button>
                                    </div>
                                </div><!--form-wraper-->
                            </form>
                        </div><!--footer-sign-up-->
                    </div><!--inside-footer-->
                </div><!--container-->
            </div><!--footer-border-->
            <div class="footer-bottom">
                <div class="container">
                    <div class="inside-footer-bottom">
                        <div class="sec-one">
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
                                ">{{$v->name}}</a>
                            @endforeach
                        </div><!--sec-one-->
                        <div class="sec-two">
                            <p> Copyright © {{date('Y')}} <a href="{{ url('/') }}">{{$setting->site_title}}</a> - All Rights Reserved </p>
                        </div>
                    </div><!--inside-footer-bottom-->
                </div>
            </div><!--footer-bottom-->    
        </div><!--footer-->