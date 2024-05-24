<?php $setting = DB::table('setting')
    ->where('id', '=', '1')
    ->first();
    $rating = DB::table('rating')
    ->where('pid', '=', $v->id)
    ->get();
    $sum = 0;
    $count = 0;
    foreach($rating as $k=> $p)
    {
        $count++;
        $sum = $sum + $p->rate;
    }
    $rate = 0;
    if($count)
    $rate = $sum /$count;
    
    
$cate = DB::table('categories')->get();
// shaheer 
    $saling_price = intval($v->selling_price);
$discount_price = intval($v->discount_price);

$tot_price = $saling_price - $discount_price;

$perctg = 0;
if($saling_price)
$perctg = ($tot_price / $saling_price) * 100;
$final_percntage = ceil($perctg);

    
?>
<div class="product-item">
                            <div class="product-image">
                                <a href="{{url('/')}}/product/{{$v->slug}}">
                                    <img src="{{env('APP_URL').$v->image_one}}" alt="Product Image">
                                </a>
                            </div>
                            <div class="product-content">
                                <div class="title"><a href="{{url('/')}}/product/{{$v->slug}}">{{$v->product_name}}</a></div>
                                <div class="ratting">
                                    <?php
                            for($i= 1; $i<=5;$i++)
                            {
                                if($i <= $rate)
                                {
                                ?>
                            <i class="fa fa-star"></i>
                            <?php
                                }
                                else
                                {
                                 ?>
                            <i class="fa fa-star-o"></i>
                            <?php   
                                }
                            }
                            ?>
                                </div>
                                <div class="price">{{$v->discount_price}} <span>{{$v->selling_price}}</span></div>
                            </div>
                        </div>