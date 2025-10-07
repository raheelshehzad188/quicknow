
<!-- Categories -->
        <section class="flat-spacing-4 flat-categorie">
            <div class="container-full">
               <div class="flat-title-v2">
                    <div class="box-sw-navigation">
                        <div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span></div>
                        <div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span></div>
                    </div>
                    <span class="text-3 fw-7 text-uppercase title wow fadeInUp" data-wow-delay="0s">SHOP BY CATEGORIES</span>
               </div>
               <div class="row">
                    <div class="col-xl-9 col-lg-12 col-md-12"> 
                        <div class="swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                            <div class="swiper-wrapper">
                                @foreach($categories as $k=> $v)
                                <div class="swiper-slide" lazy="true">
                                    <div class="collection-item style-left hover-img">
                                        <div class="collection-inner">
                                            <a href="{{ url('') }}/category/{{$v->slug}}" class="collection-image img-style">
                                                <img class="lazyload" data-src="{{env('IMG_URL')}}{{ $v->image}}" src="{{env('IMG_URL')}}{{ $v->image}}" alt="collection-img">
                                            </a>
                                            <div class="collection-content">
                                                <a href="{{ url('') }}/category/{{$v->slug}}" class="tf-btn collection-title hover-icon fs-15"><span>{{$v->name}}</span><i class="icon icon-arrow1-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-4">
                        <div class="discovery-new-item">
                            <h5>Discovery all new items</h5>
                            <a href="{{ url('/shop') }}"><i class="icon-arrow1-top-left"></i></a>
                        </div>
                    </div>
                    </div>
               </div>
               
            </div>
        </section>
        