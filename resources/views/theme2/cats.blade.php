<!--categories-->
<div class="categories">
    <div class="container">
        <div class="inside-categories">
            @if(isset($categories) && count($categories) > 0)
                @foreach($categories as $category)
                <div class="section-category">
                    <a href="{{ url('category/' . $category->slug) }}">    
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                        <p>{{ $category->name }}</p>
                    </a>
                </div><!--section-category-->
                @endforeach
            @else
                <!-- Default categories if no data -->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default1.webp') }}" alt="Beauty And Personal Care">
                        <p>Beauty And Personal Care</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default2.webp') }}" alt="Health & Wellness">
                        <p>Health & Wellness</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default3.webp') }}" alt="Fashion & Style">
                        <p>Fashion & Style</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default4.webp') }}" alt="Home & Living">
                        <p>Home & Living</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default5.webp') }}" alt="Electronics">
                        <p>Electronics</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default6.webp') }}" alt="Sports & Fitness">
                        <p>Sports & Fitness</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default7.webp') }}" alt="Books & Media">
                        <p>Books & Media</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default8.webp') }}" alt="Toys & Games">
                        <p>Toys & Games</p>
                    </a>
                </div><!--section-category-->
                <div class="section-category">
                    <a href="#">    
                        <img src="{{ asset('public/images/category/default9.webp') }}" alt="Automotive">
                        <p>Automotive</p>
                    </a>
                </div><!--section-category-->
            @endif
        </div><!--inside-categories-->
    </div><!--container-->
</div><!--categories-->
