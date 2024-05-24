@extends('layout.app2')

<?php
use App\Models\Catagorie;
use App\Models\Subcatagorie;
use App\Models\Childcatagorie;
use App\Models\Admins\Category;
use App\Models\Admins\Gallerie;
use App\Models\Admins\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Admins\Setting;
use App\Models\Admins\Rating;
?>


@section('content')

<!-- Page Header Start -->
       
        
    @if(!empty($rproducts) && $rproducts->count())
        <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
           


            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                     @foreach ($rproducts as  $k=>$v)
                @if($v->status == 1)
                    
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                @include('includes/parts/product_box')
            </div>
                    @endif
                @endforeach
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

               
              
              
           

    @else
    <tr>
        <td colspan="10">There are no data.</td>
    </tr>
    @endif
               

@endsection
