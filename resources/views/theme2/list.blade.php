@extends($layout)
@section('content')
<?php 
use App\Models\Admins\Category;
?>
<style>
    svg{
        width:50px !important;
    }
</style>
<!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">{{ $title }}</div>
            </div>
        </div>
        <!-- /page-title -->
          
        <div class="all-products">
            <div class="container">
                <div class="inside-all-products">
                @foreach ($products as  $k=>$v)
                    @include('theme2/product_box')
                    @endforeach
                    @if (!isset($pagination) && $products->hasPages())
    <div class="pagination-wrapper">
         {{ $products->links() }}
    </div>
    @endif
                    

                </div><!--inside-new-arrivals-->
            </div><!--container-->
        </div><!--new-arrivals-->

                
               
                 
                
             
                       
                     
@endsection
