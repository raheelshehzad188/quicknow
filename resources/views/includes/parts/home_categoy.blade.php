<!-- Category Start-->
        <div class="category">
            <div class="container-fluid">
                <div class="row">
                    @if(isset($categories[0]))
                    <div class="col-md-4">
                        <div class="category-img">
                            <img src="{{env('APP_URL').$categories[0]->image}}" />
                            <a class="category-name" href="{{ url('/category') }}/{{$categories[0]->slug}}">
                                <h2>{{$categories[0]->name}}</h2>
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-4">
                        @if(isset($categories[1]))
                        <div class="category-img">
                            <img src="{{env('APP_URL').$categories[1]->image}}" />
                            <a class="category-name" href="{{ url('/category') }}/{{$categories[1]->slug}}">
                                <h2>{{$categories[1]->name}}</h2>
                            </a>
                        </div>
                        @endif
                        @if(isset($categories[2]))
                        <div class="category-img">
                            <img src="{{env('APP_URL').$categories[2]->image}}" />
                            <a class="category-name" href="{{ url('/category') }}/{{$categories[2]->slug}}">
                                <h2>{{$categories[2]->name}}</h2>
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if(isset($categories[3]))
                        <div class="category-img">
                            <img src="{{env('APP_URL').$categories[3]->image}}" />
                            <a class="category-name" href="{{ url('/category') }}/{{$categories[3]->slug}}">
                                <h2>{{$categories[3]->name}}</h2>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Category End-->