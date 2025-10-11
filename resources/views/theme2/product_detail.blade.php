@extends($layout)

<?php
use App\Models\Admins\Category;
use App\Models\Admins\Product;
use App\Models\Admins\Gallerie;
use App\Models\Admins\Rating;
$faq= DB::table('pfaqs')->where('product_id',$item->id)->get();
$files = Gallerie::where('product_id',$item->id)->get();

function get_rating_html($rating) {
    $rating = (int)$rating;
    $html = '<div class="star-rating">';
    
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $html .= '<img src="' . $assets_url . 'images/star-fill-large.svg" alt="star">';
        } else {
            $html .= '<img src="' . $assets_url . 'images/star-empty.svg" alt="star">';
        }
    }

    $html .= '</div>';
    return $html;
}

// Calculate average rating
$count = 0;
$totalrating = 0;
$getreview = DB::table('rating')->where('status', '1')->where('pid', $item->id)->orderby('id', 'desc')->get();
$countcustomer = DB::table('rating')->where('status', '1')->where('pid', $item->id)->count();
if($countcustomer != 0 && $getreview){
    foreach ($getreview as $avg){
        $count = $count + $avg->rate;
    }
    $totalrating = $count / $countcustomer;
    $finalresult = round($totalrating);
}

// Calculate discount percentage
$discount_percentage = 0;
if($item->selling_price > 0 && $item->discount_price > 0) {
    $discount_percentage = round((($item->selling_price - $item->discount_price) / $item->selling_price) * 100);
}

// Get related products
$rproducts = Product::where('category_id','=',$item->category_id)->where('id','!=',$item->id)->limit(8)->get();

// Get settings for WhatsApp
$setting = DB::table('setting')->where('id', '=', '1')->first();
?>

@section('content')
<div class="content-indicator">
    <div class="container">
        <div class="inside-content-indicator">
            <ul>
                        <li> <a href="#"> Home </a> </li>
                        <li> <a href="#"> Categories </a> </li>
                        <li> <a href="#"> Beauty And Personal Care </a> </li>
            </ul>
        </div><!--inside-content-indicator-->
    </div><!--container-->
</div><!--content-indicator-->

<!--single-page-->
        
<div class="single-page">
                <div class="container">
        <div class="inside-single-page">
            <div class="single-page-product-image">
                        <?php
                        // Determine main image: prefer product's main image, else first gallery image, else fallback asset
                        $mainImage = null;
                        if (!empty($item->image_one)) {
                            $mainImage = custom_assets($item->image_one);
                        } elseif (isset($files) && count($files) > 0) {
                            $mainImage = url($files[0]->photo);
                        } else {
                            $mainImage = custom_assets('theme2/img/solo.webp');
                        }
                        ?>
                        <img id="mainProductImage" src="{{ $mainImage }}" alt="Main Product">
                
                <div class="single-page-product-image-section">
                            @if(!empty($item->image_one))
                            <img src="{{ custom_assets($item->image_one) }}" alt="thumb" onclick="changeImage(this)">
                            @endif
                            @if(isset($files) && count($files) > 0)
                                @foreach($files as $galleryImage)
                                    <img src="{{ custom_assets($galleryImage->photo) }}" alt="thumb" onclick="changeImage(this)">
                                @endforeach
                            @endif
                                    </div>
                                </div>
            <div class="single-page-product-details">
                        <h1>{{ $item->product_name }}</h1>
                        <h2> <a href="#">  Ayan Store </a> </h2> 
                <div class="rating-media-single-page">
                    <div class="rating-review">
                                <img src="{{ custom_assets('theme2/img/solo-rating.svg') }}">
                                <img src="{{ custom_assets('theme2/img/solo-rating.svg') }}">
                                <img src="{{ custom_assets('theme2/img/solo-rating.svg') }}">
                                <img src="{{ custom_assets('theme2/img/solo-rating.svg') }}">
                                <img src="{{ custom_assets('theme2/img/solo-rating.svg') }}">
                        <div class="rating-reviews-btn">
                                    <button> (1 Reviews) </button>
                        </div>
                    </div><!--rating-media-single-page-->
                    <div class="single-page-media">
                        <ul>
                                    <li> <a href="#"> <img src="{{ custom_assets('theme2/img/facebook-icon.svg') }}"> </a> </li>
                                    <li> <a href="#"> <img src="{{ custom_assets('theme2/img/twitter-icon-large.svg') }}"> </a> </li>
                                    <li> <a href="#"> <img src="{{ custom_assets('theme2/img/linkedin-icon-01.svg') }}"> </a> </li>
                                    <li> <a href="#"> <img src="{{ custom_assets('theme2/img/pinterest-icon-large.svg') }}"> </a> </li>
                                    <li> <a href="#"> <img src="{{ custom_assets('theme2/img/whatsapp-icon-large.svg') }}"> </a> </li> 
                       </ul>
                    </div><!--single-page-media-->
                </div><!--rating-media-single-page-->
                <div class="was-price">
                            <span class="was-span"> Was: </span>
                            <span class="discounted-span"> Rs: {{ $item->selling_price }} </span>
                                    </div>
                <div class="now-price">
                            <span class="now-span"> Now: </span>
                            <span class="now-price-span"> Rs: {{ $item->discount_price }} </span>
                                        </div>
                <div class="savings">
                            <span class="savings-span"> Save: </span>
                            <span class="savings-price-span"> Rs: {{ $item->selling_price - $item->discount_price }} </span><span class="savings-price-of-span"> {{ $discount_percentage }}% Off </span>
                                    </div>
                <div class="buy-cart-buttons">
                            <a href="add-to-cart.php">
                                <button class="buy-now-btn"> BUY NOW </button>
                    </a>
                            <button class="add-to-cart-btn" onclick="addToCart({{ $item->id }})"> ADD TO CART </button>
                                    </div>
                        <div class="border-bottom-single-page">
                        </div>
                        <h3> {{ $item->product_name }} Overview</h3>
                        <p> {!! $item->product_details !!} </p>
            </div><!--single-page-product-details-->
            <div class="warrenty-detail-single-pg">
                <div class="warrenty-section">
                    <div class="warenty-section-image">
                                <img src="{{ custom_assets('theme2/img/auth.png') }}">
                                        </div>
                    <div class="warrenty-heading">
                                <h3> warrenty </h3>
                                <p> 7 Days Check Warrenty </p>
                                        </div>
                                    </div>
                
                <div class="warrenty-section">
                    <div class="warenty-section-image">
                                <img src="{{ custom_assets('theme2/img/delivery.png') }}">
                                            </div>
                    <div class="warrenty-heading">
                                <h3> delivery </h3>
                                <p> Expected Delivery | 21 SEPTEMBER - 24 SEPTEMBER </p>
                                                </div>
                                            </div>

                <div class="warrenty-section">
                    <div class="warenty-section-image">
                                <img src="{{ custom_assets('theme2/img/availablity.png') }}">
                                                    </div>
                    <div class="warrenty-heading">
                                <h3> Availability </h3>
                                <p> Yes </p>
                                                </div>
                                            </div>

                        <div class="border-bottom-single-page">
                        </div>

                <div class="warrenty-section">
                    <div class="warenty-section-image">
                                <img src="{{ custom_assets('theme2/img/payments.png') }}">
                    </div>
                    <div class="warrenty-heading">
                                <h3> payment </h3>
                                <p> We offer easy and secure payment options: bank transfer, JazzCash, or EasyPaisa. </p>
                                        </div>
                                    </div>

                <div class="warrenty-section">
                    <div class="warenty-section-image">
                                <img src="{{ custom_assets('theme2/img/policy.png') }}">
                                        </div>
                    <div class="warrenty-heading">
                                <h3> 7 days return policy </h3>
                                <p> We offer a 7-day easy return or exchange policy. Customers only cover delivery charges. </p>
                                        </div>
                                    </div>

                <div class="warrenty-section">
                    <div class="warenty-section-image">
                                <img src="{{ custom_assets('theme2/img/originalp.png') }}">
                    </div>
                    <div class="warrenty-heading">
                                <h3> 100% Original Products </h3>
                                <p> Guaranteed: 100% original products. </p>
                                </div>
                            </div>

                <div class="warrenty-section">
                    <div class="warenty-section-image">
                                <img src="{{ custom_assets('theme2/img/Satisfaction.png') }}">
                        </div>
                    <div class="warrenty-heading">
                                <h3> Customer Satisfaction </h3>
                                <p> Our priority: Your satisfaction. We value your feedback to improve. </p>
                    </div>
                </div>
            </div><!--warrenty-detail-single-pg-->
        </div><!--inside-single-page-->
    </div><!--container-->
</div><!--single-page-->

<div class="overview-rating-section">
            <div class="container">
        <!-- Tab Buttons -->
        <ul class="tab-menu">
            <li class="tab-link active" data-tab="overview">Overview</li>
            <li class="tab-link" data-tab="reviews">Rating & Reviews</li>
                            </ul>

        <!-- Tab Contents -->
        <div class="tab-content active" id="overview">
                    <h2> Buy {{ $item->product_name }} Online in Pakistan From AyanStore.Pk </h2>
                    <h3>{{ $item->product_name }}:</h3>
                    <p>
                        {{ $item->product_details }}
                    </p>
                    <h2> Looking to Buy Original {{ $item->product_name }} in Pakistan? Get It at the Best Price – Rs.{{ $item->discount_price }} </h2>
                    <p>
                        Order now from AyanStore.Pk and have the original {{ $item->product_name }} delivered straight to your home! Offering unbeatable prices and exclusive deals, AyanStore.Pk provides {{ $item->product_name }} across major cities including Karachi, Lahore, Islamabad, and all over Pakistan. Enjoy the convenience of Cash on Delivery.
                    </p>
                    <p>
                        <b>
                        Don't Miss Out! Shop online today for the best {{ $item->product_name }} deals in Pakistan only at AyanStore.Pk!
                        </b>
                    </p>
                                </div>

        <div class="tab-content" id="reviews">
                
            <div class="review-box">
                        <h2> Customer Reviews for {{ $item->product_name }} </h2>
                <div class="write-review-section">
                    <div class="review-box-ratings">
                                <img src="{{ custom_assets('theme2/img/star-fill-large.svg') }}">
                                <img src="{{ custom_assets('theme2/img/star-fill-large.svg') }}">
                                <img src="{{ custom_assets('theme2/img/star-fill-large.svg') }}">
                                <img src="{{ custom_assets('theme2/img/star-fill-large.svg') }}">
                                <img src="{{ custom_assets('theme2/img/star-fill-large.svg') }}">
                                <p>Based on 1 reviews</p>
                                </div>
                    <div class="write-a-review">
                        <button type="button" id="toggleReviewForm">Write a Review</button>
                    </div>
                            
                </div><!--write-review-section-->
                <div class="review-form" id="reviewForm" style="display:none;">
                                <form action="#" method="post">
                        
                        <div class="form-row full-width">
                            <label for="stars">Select Stars</label>
                                    <select id="stars" name="stars" required>
                                <option value="5">5 Star [Excellent]</option>
                                <option value="4">4 Star [Very Good]</option>
                                <option value="3">3 Star [Good]</option>
                                <option value="2">2 Star [Fair]</option>
                                <option value="1">1 Star [Poor]</option>
                            </select>
                        </div>

                        <div class="form-row">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Name" required>
                        </div>

                        <div class="form-row">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-row full-width">
                            <label for="review">Your Review</label>
                            <textarea id="review" name="review" placeholder="Please write your feedback to us" required></textarea>
                        </div>

                        <div class="form-row full-width">
                            <button type="submit">Submit <br> Review</button>
                        </div>

                    </form>
                </div><!--review-form-->
                <div class="write-review-section2">
                    <div class="review-box-ratings">
                                <img src="img/star-fill-large.svg">
                                <img src="img/star-fill-large.svg">
                                <img src="img/star-fill-large.svg">
                                <img src="img/star-fill-large.svg">
                                <img src="img/star-fill-large.svg">
                                <h3> Verified Purchase </h3>
                                <p>Good Result For hair Oil</p>
                </div>
                    <div class="write-a-review">
                                <span class="review-passed"><strong> Javeed  </strong> on  <strong> 22 Sep  </strong> </span>
                    </div>
                </div><!--write-review-section-->
            </div>
        </div><!--tab-content-->
                

    </div><!--container-->
</div><!--overview-rating-section-->

<!--most-buying-products-->

<div class="new-arrivals">
    <div class="container">
        <div class="inside-new-arrivals">
            <div class="new-arrivals-heading">
                        <h1> <a href="#"> Most Buying Products </a> </h1>
            </div><!--new-arrivals-heading-->

            <div class="slider-wrapper" data-slider="hair">
                <button class="product-slide-btn left prev">&#10094;</button>
                            <div class="products-section" >
                                <div class="single-product-section product">
                                    <div class="product-image">
                                        <img src="{{ custom_assets('theme2/img/serum.webp') }}">
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="{{ custom_assets('theme2/img/rating.png') }}">
                                        </div><!--rating-->
                                        <div class="sale-button">
                                            <button> 20% </button>
                                        </div><!--sale-button-->
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                                <div class="single-product-section product">
                                    <div class="product-image">
                                        <img src="{{ custom_assets('theme2/img/serum.webp') }}">
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="{{ custom_assets('theme2/img/rating.png') }}">
                                        </div><!--rating-->
                                        <div class="sale-button">
                                            <button> 20% </button>
                                        </div><!--sale-button-->
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                                <div class="single-product-section product">
                                    <div class="product-image">
                                        <img src="{{ custom_assets('theme2/img/serum.webp') }}">
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="{{ custom_assets('theme2/img/rating.png') }}">
                                        </div><!--rating-->
                                        <div class="sale-button">
                                            <button> 20% </button>
                                        </div><!--sale-button-->
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                                <div class="single-product-section product">
                                    <div class="product-image">
                                        <img src="{{ custom_assets('theme2/img/serum.webp') }}">
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="{{ custom_assets('theme2/img/rating.png') }}">
                                        </div><!--rating-->
                                        <div class="sale-button">
                                            <button> 20% </button>
                                        </div><!--sale-button-->
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                                <div class="single-product-section product">
                                    <div class="product-image">
                                        <img src="{{ custom_assets('theme2/img/serum.webp') }}">
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="{{ custom_assets('theme2/img/rating.png') }}">
                                        </div><!--rating-->
                                        <div class="sale-button">
                                            <button> 20% </button>
                                        </div><!--sale-button-->
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                                <div class="single-product-section product">
                                    <div class="product-image">
                                        <img src="{{ custom_assets('theme2/img/serum.webp') }}">
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="{{ custom_assets('theme2/img/rating.png') }}">
                                        </div><!--rating-->
                                        <div class="sale-button">
                                            <button> 20% </button>
                                        </div><!--sale-button-->
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                                <div class="single-product-section product">
                                    <div class="product-image">
                                        <img src="img/serum.webp">
                                    </div><!--product-image-->
                                    <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                                    </div><!--product-detail-section-->
                                    <div class="product-rating-section">
                                        <div class="ratings">
                                            <img src="img/rating.png">
                                        </div><!--rating-->
                                        <div class="sale-button">
                                            <button> 20% </button>
                                        </div><!--sale-button-->
                                    </div><!--product-rating-section-->
                                </div><!--single-product-section-->
                    <div class="single-product-section product">
                        <div class="product-image">
                                        <img src="img/serum.webp">
                        </div><!--product-image-->
                        <div class="product-detail-section">
                                        <h3> <a href="#"> 92% Snail Mucin Serum </a> </h3>
                                        <p> <strong> Rs. 2000 </strong> <span class="discounted-price"> 400 </span> </p>
                        </div><!--product-detail-section-->
                        <div class="product-rating-section">
                            <div class="ratings">
                                            <img src="img/rating.png">
                            </div><!--rating-->
                            <div class="sale-button">
                                            <button> 20% </button>
                            </div><!--sale-button-->
                        </div><!--product-rating-section-->
                    </div><!--single-product-section-->
                </div><!--products-section-->
                        <button class="product-slide-btn right next" >&#10095;</button>
            </div><!--slider-wrapper-->

        </div><!--inside-new-arrivals-->
    </div><!--container-->
</div><!--new-arrivals-->
@endsection