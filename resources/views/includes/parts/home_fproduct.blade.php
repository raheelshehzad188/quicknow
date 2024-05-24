<?php
$setting = DB::table('setting')
    ->where('id', '=', '1')
    ->first();
?>
<div class="featured-product">
            <div class="container">
                <div class="section-header">
                    <h3>Featured Product</h3>
                    <p>
                        {!! $setting->homepage_img6d !!}
                    </p>
                </div>
                <div class="row align-items-center product-slider product-slider-4">
                    
                        @foreach ($fproducts as  $k=>$v)
                        <div class="col-lg-12">
                        @include('includes/parts/product_box')
                        </div>
                        @endforeach
                </div>
            </div>
        </div>