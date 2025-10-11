<!--photos-section-->

<div class="photos-section">
            <div class="container">
                <div class="inside-photos-section">
                    @if(isset($setting->homepage_img1d) && !empty($setting->homepage_img1d))
                        <div class="photos-section-part">
                            {!! $setting->homepage_img1d !!}
                        </div><!--photos-section-->
                    @elseif(isset($setting->homepage_image_one) && !empty($setting->homepage_image_one))
                        <div class="photos-section-part">
                            <a href="#"> <img src="{{ asset($setting->homepage_image_one) }}" alt="Home Image 1"> </a>
                        </div><!--photos-section-->
                    @else
                    <div class="photos-section-part">
                        <a href="#"> <img src="{{ custom_assets('theme2/img/7a04eb6b0ca74b89f482b50892a82702.webp') }}"> </a>
                    </div><!--photos-section-->
                    @endif
                    @if(isset($setting->homepage_img2d) && !empty($setting->homepage_img2d))
                        <div class="photos-section-part">
                            {!! $setting->homepage_img2d !!}
                        </div><!--photos-section-->
                    @elseif(isset($setting->homepage_image_two) && !empty($setting->homepage_image_two))
                        <div class="photos-section-part">
                            <a href="#"> <img src="{{ asset($setting->homepage_image_two) }}" alt="Home Image 2"> </a>
                        </div><!--photos-section-->
                    @else
                    <div class="photos-section-part">
                        <a href="#"> <img src="{{ custom_assets('theme2/img/twoo.webp') }}"> </a>
                    </div><!--photos-section-->
                    @endif
                    @if(isset($setting->homepage_img3d) && !empty($setting->homepage_img3d))
                        <div class="photos-section-part">
                            {!! $setting->homepage_img3d !!}
                        </div><!--photos-section-->
                    @elseif(isset($setting->homepage_image_3) && !empty($setting->homepage_image_3))
                        <div class="photos-section-part">
                            <a href="#"> <img src="{{ asset($setting->homepage_image_3) }}" alt="Home Image 3"> </a>
                        </div><!--photos-section-->
                    @else
                    <div class="photos-section-part">
                        <a href="#"> <img src="{{ custom_assets('theme2/img/onee.webp') }}"> </a>
                    </div><!--photos-section-->
                    @endif
                </div><!--inside-photos-section-->
            </div><!--cont-->
        </div><!--photos-section-->

        <!--new-arrivals-->

        <div class="new-arrivals">
            <div class="container">
                <div class="inside-new-arrivals">
                    <div class="new-arrivals-heading">
                        <h1> <a href="#"> NEW ARRIVALS </a> </h1>
                    </div><!--new-arrivals-heading-->

                    <div class="slider-wrapper" data-slider="products">
                        <button class="product-slide-btn left prev">&#10094;</button>
                            <div class="products-section" >
                                @foreach ($aproducts as $k => $v)
                                <?php 
                                $setting = DB::table('setting')->where('id', '=', '1')->first();
                                $rating = DB::table('rating')->where('pid', '=', $v->id)->get();
                                $sum = 0;
                                $count = 0;
                                foreach($rating as $k=> $p) {
                                    $count++;
                                    $sum = $sum + $p->rate;
                                }
                                $rate = 0;
                                if($count) {
                                    $rate = $sum / $count;
                                }

                                // Calculate discount percentage
                                $saling_price = intval($v->selling_price);
                                $discount_price = intval($v->discount_price);
                                $tot_price = $saling_price - $discount_price;
                                $perctg = 0;
                                if($saling_price) {
                                    $perctg = ($tot_price / $saling_price) * 100;
                                }
                                $final_percntage = ceil($perctg);
                                ?>
                                <a href="{{ url('/product/' . $v->slug) }}" class="product-link">    
                                <div class="single-product-section product">
                                    <div class="product-image">
                                            <a href="{{ url('/product/' . $v->slug) }}"> 
                                                <img src="{{ custom_assets($v->image_one) }}" alt="{{ $v->product_name }}">
                                            </a>
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                            <h3> 
                                                <a href="{{ url('/product/' . $v->slug) }}">{{ $v->product_name }}</a> 
                                            </h3>
                                            <p> 
                                                <strong>Rs. {{ number_format($v->selling_price) }}</strong> 
                                                @if($v->discount_price > 0)
                                                    <span class="discounted-price">Rs. {{ number_format($v->discount_price) }}</span>
                                                @endif
                                            </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="{{ custom_assets('theme2/img/rating.png') }}">
                                        </div><!--rating-->
                                            @if($v->discount_price > 0 && $final_percntage > 0)
                                        <div class="sale-button">
                                                    <button>{{ $final_percntage }}%</button>
                                        </div><!--sale-button-->
                                            @endif
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                            </a>    
                                @endforeach
                            </div><!--products-section-->
                        <button class="product-slide-btn right next" >&#10095;</button>    
                    </div><!--slider-wrapper-->    

                </div><!--inside-new-arrivals-->
            </div><!--container-->
        </div><!--new-arrivals-->

        <!--single-photo-section-->
        
        <div class="single-photos-section">
            <div class="container">
                <div class="sin-photos-section-part">
                    @if(isset($setting->homepage_img4d) && !empty($setting->homepage_img4d))
                        {!! $setting->homepage_img4d !!}
                    @elseif(isset($setting->homepage_image_4) && !empty($setting->homepage_image_4))
                        <a href="#"> <img src="{{ asset($setting->homepage_image_4) }}" alt="Home Image 4"> </a>
                    @else
                    <a href="#"> <img src="{{ custom_assets('theme2/img/fashion.webp') }}"> </a>
                    @endif
                </div><!--photos-section-->
            </div><!--cont-->
        </div><!--single-photos-section-->