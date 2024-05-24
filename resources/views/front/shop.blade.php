@extends('layout.app2')
@section('content')
<?php 
use App\Models\Admins\Category;
$cate = Category::limit('6')->get();
?>
<style>
   #svg span svg {
    width: 22px;
}
#svg a {
    padding: 5px !important;
}

#svg  nav  .flex 
{
     display:none;  
}
</style>
     <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
           


            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                     @php $products = DB::table('products')->orderby('id', 'desc')
                  ->paginate(40);
                  @endphp
                     @foreach ($products as  $k=>$v)
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        @include('includes/parts/product_box')
                    </div>
                    @endforeach
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3" id="svg">
                             {!!$products->render()  !!}
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
                
               
                 
                
             
                       
                     
@endsection
