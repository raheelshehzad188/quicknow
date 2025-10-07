@extends('layout.app2')

<?php
use App\Models\Admins\Category;
use App\Models\Admins\SubCategory;
use App\Models\Childcatagorie;
use App\Models\product;
use App\Models\Admins\Gallerie;
  ?>
  <?php $setting = DB::table('setting')
    ->where('id', '=', '1')
    ->first();
$cate = DB::table('categories')->get();
?>


@section('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

@if (Session::has('cart'))
    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <!--<th>Shipping Charges</th>-->
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                        $tot = 0;
                        @endphp
                        @foreach (App\Helpers\Cart::products() as $product)
                        @php
                        $tot = $tot+ ($product->discount_price* $product->qty);
                        @endphp
                        <tr>
                            <td class="align-middle"><img src="/{{$product->image_one}}" alt="" style="width: 50px;"> {{$product->product_name}}</td>
                            <td class="align-middle">Rs {{$product->discount_price}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus minus" type="button" productId="{{$product->id}}" productprice="{{$product->price}}">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" id="qty{{$product->id}}" name="qty" value="{{$product['qty']}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus plus" type="button" productId="{{$product->id}}" productprice="{{$product->price}}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <!--<td class="align-middle">Rs {{$product->shipping_price}}</td>-->
                            <td class="align-middle"><button class="btn btn-sm btn-primary ion-close" productId="{{$product->id}}"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Sub Total</h5>
                            <h5 class="font-weight-bold">Rs: <span class="price" id="cartTotal1"><b> {{$tot}}</b></h5>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Shipping Fee</h5>
                            <h5 class="font-weight-bold">Rs: <span id="price"><b> {{ Session::has('cart') ? $setting->shipping_charges : 0 }}</b></h5>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">Rs: <span class="price" id="cartTotal"><b> {{$tot +$setting->shipping_charges}}</b></h5>
                        </div>
                        <a href="/checkout" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
   @else
            <h3 class="text-center">Your Cart Is Empty!</h3>
        @endif
  <!-- CONTAINER END -->
  
<script>
    let id,qty,price,productTotal;
    $(document).ready(function(){

        $('.ion-close').click(function(e){
        e.preventDefault();
           id = $(this).attr('productId');
          $.ajax({
              url : "{{url('cart/remove')}}",
              type : "POST",
              data : {
                  id : id,
                  "_token": "{{ csrf_token() }}",
              },
              success:function(response){
                  location.reload();
                  console.log(id);
                  removeFromView(id,response);
                  updateView(response);
                  location.reload();
              }
          });
      }); 
      

        $('.clear').click(function(e){
        e.preventDefault();
        //   id = $(this).attr('productId');
          $.ajax({
              url : "{{url('cart/clear')}}",
              type : "POST",
              data : {
                  
                  "_token": "{{ csrf_token() }}"
              },
              success:function(response){
                  location.reload();
                  
              }
          });
      }); 
      
      $('.plus').click(function(){
         id = $(this).attr('productId');
           var qty = $('#qty'+id).val();
           price = $(this).attr('productprice');
          $.ajax({
              url : "{{url('cart/increment')}}",
              type : "POST",
              data : {
                  id : id,
                  "_token": "{{ csrf_token() }}",
              },
              success:function(response){
                 qty++;
                  $('#qty'+id).val(qty);
                  updateView(response,price);
              }
          });
      });

      $('.minus').click(function(){
           id = $(this).attr('productId');
           var qty = $('#qty'+id).val();
           price = $(this).attr('productprice');
          $.ajax({
              url : "{{url('cart/decrement')}}",
              type : "POST",
              data : {
                  id : id,
                  "_token": "{{ csrf_token() }}",
              },
              success:function(response){
                  qty--;
                  $('#qty'+id).val(qty);
                  updateView(response,price);
                 
              }
          });
      });

      function updateView(response){
        productTotal=parseInt(qty*price);
          $('#cartValue').html(response.cart.qty);
          $('#price').html(response.cart.ship);
          $('#cartTotal').html(response.cart.amount+{{ Session::has('cart') ? $setting->shipping_charges : 0 }});
          $('#cartTotal1').html(response.cart.amount);
          $('#productTotal'+id).html(productTotal);
      }
      
    });
</script>



@endsection