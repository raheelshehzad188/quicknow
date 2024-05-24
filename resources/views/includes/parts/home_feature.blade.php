<!-- Feature Start-->
<div class="feature">
    <div class="container-fluid">
        <div class="row">
            @foreach($boxes as $k=> $v)
            <div class="col-lg-3 col-md-3 col-sm-6 feature-col">
                <div class="feature-content">
                    <i class="fa fa-{{$v->icon}}"></i>
                    <h2>{{$v->txt}}</h2>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Feature End-->