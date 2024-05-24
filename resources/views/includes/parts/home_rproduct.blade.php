<!-- Recent Product Start -->
<?php
$setting = DB::table('setting')
    ->where('id', '=', '1')
    ->first();
?>
<style>
    
</style>
<div class="recent-product">
    <div class="container">
        <div class="section-header">
            <h3>Recent Product</h3>
            <p>
                {!! $setting->homepage_img6d !!}
            </p>
        </div>
        <div class="row align-items-center product-slider product-slider-4 product-sliderss">
            @foreach ($aproducts as  $k=>$v)
                        <div class="col-lg-12">
                        @include('includes/parts/product_box')
                        </div>
                        @endforeach
        </div>
    </div>
</div>
<!-- Recent Product End -->