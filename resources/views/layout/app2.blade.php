<?php
use App\Models\Admins\Pages;
use App\Models\Admins\Setting;
$Site= Setting::where(['id'=>'1'])->first();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<!--[if IE]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <![endif]-->
<meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- Mobile specific metas  -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicon  -->
    @if(isset($meta_file))
    @include($meta_file)
    @endif

   @if(isset($meta) && $meta)

    @if(Session::has('title'))
    <title>{{$meta->title}} | {{$Site->site_title}}</title>
    @else
      <title>{{ Session::get('title')}}</title>
      @endif
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @if(isset($meta->scheme1))
    <script type="application/ld+json">
    {{$meta->scheme1}}
    </script>
    @endif
    @if(isset($meta->scheme))
    <script type="application/ld+json">
    @json($meta->scheme);
    </script>
    @endif
    

@elseif(isset($tags))

    <title>{{ $tags }}</title>
    <meta name="title" content="{{ $tags }}" />
    <meta name="description" content="{{ $tags }}" />
    <meta name="keywords" content="{{ $tags }}" />
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1">
    <meta name="bingbot" content="index,follow,max-snippet:-1,max-image-preview:large,max-video-preview:-1">
    <link rel="canonical" href="{{ env('APP_URL').'/tags/'.$slug; }}" />
    <link rel="alternate" type="application/rss+xml" href="{{env('APP_URL'); }}/sitemap.xml" />


@else
@if(Session::has('title'))
    <title>{{Session::get('title')}} | {{$Site->site_title}}</title>
    @else
      <title>{{$Site->site_title}}</title>
      @endif
@endif

    <?php $Settings = Setting::where(['id'=>'1'])->get(); ?>
    @foreach($Settings as $Setting)
    <!--<link rel="icon" type="image/x-icon" href="{{asset('')}}/images/favicon.png">-->
    <link rel="shortcut icon" href="{{env('APP_URL')}}{{$Setting->logo1}}" type="image/x-icon"/ >
    @endforeach
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <!-- BEGIN: Page CSS-->
    

    <!-- Customized Bootstrap Stylesheet -->
    <!--<link href="{{asset('')}}front/assets/css/style.css" rel="stylesheet">-->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{env('APP_URL')}}front/lib/slick/slick.css" rel="stylesheet">
    <link href="{{env('APP_URL')}}front/lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{env('APP_URL')}}front/css/style.css" rel="stylesheet">
    @php
    
    
    @endphp
    <style>
        :root {
          --blue: {{$Site->color1}}; 
          --grey: {{$Site->color2}};
          --yellows: {{$Site->bg_primary}};
       }


    </style>
</head> 

<body>

   
   <!-- BEGIN: Header-->
        <!-- END: Header-->
   @include('includes.front.header3')

        <!-- BEGIN: Content-->
        @yield('content')
        <!-- BEGIN: End content-->

        <!-- Footer Area -->
        {{ view('front.footer1') }}
        <!-- End Footer Area -->

   <!-- Back to Top -->
   <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>


   <!-- JavaScript Libraries -->
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
   <script src="{{env('APP_URL')}}front/lib/easing/easing.min.js"></script>
   <script src="{{env('APP_URL')}}front/lib/slick/slick.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


   <!-- Template Javascript -->
   <script src="{{env('APP_URL')}}front/js/main.js"></script>
   <script>
  $(document).ready(function() {
      $('.btn-plus').click(function(){
          var qty = $('#qty').val();
          qty++;
          $('#qty').val(qty);
      });
      $('.btn-minus').click(function(){
          var qty = $('#qty').val();
          qty--;
          $('#qty').val(qty);
      });
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let qty = $('#qty').val();
        $.ajax({
            url: "/cart/add",
            method: "POST",
            data: {
                id: id,
                qty: qty,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                if (response.error) {
                    // Handle error response
                } else {
                    $('#cartValue').html(response.qty);
                    $('#cartValue1').html(response.qty);
                    $('#cartValue2').html(response.qty);
                    Swal.fire({
  title: "Good job!",
  text: response.msg,
  icon: "success"
});
                    $.post('{{ route('cart_data') }}', {_token:'{{ csrf_token() }}'}, function(data){
                        $('#cart_data').html(data);
                    });
                    $.post('{{ route('hearder_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
                        $('#hearder_cart').html(data);
                    });
                    $('#myModal').modal({ show: true });
                }
            },
            cache: false // Disable caching for the AJAX response
        });
    });
});
       $(document).ready(function() {
    $('.add-to-cart-item').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let qty = $('#qty').val();
        $.ajax({
            url: "/cart/add",
            method: "POST",
            data: {
                id: id,
                qty: qty,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                if (response.error) {
                    // Handle error response
                } else {
                    $('#cartValue').html(response.qty);
                    $('#cartValue1').html(response.qty);
                    $('#cartValue2').html(response.qty);
                    Swal.fire({
  title: "Good job!",
  text: response.msg,
  icon: "success"
});
                    $.post('{{ route('hearder_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
                        $('#hearder_cart').html(data);
                    });
                }
            },
            cache: false // Disable caching for the AJAX response
        });
    });
});

 $(document).ready(function() {
         $('.name-click').click(function(e) {
            e.preventDefault();
            var slug = $(this).data('slug'); 
            var url = '{{ url('/category') }}/' + slug; 
            window.location.href = url; 
        });
    });

         $(document).ready(function() {
            $('.add-to-cart-item1').click(function(e) {
               e.preventDefault();
               
                let id = $(this).attr('id');

                $.ajax({
                    url: "/cart/add",
                    method: "POST",
                    data: {
                        id: id,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.error) {


                        } else {
                             window.location.href = "/checkout";
                            
                           
                        }
                    }
                });
            });
        });
        
        function showToastr(msg,msg_type)
        {
            switch(msg_type)
                {
                    case "success":
                    toastr.success(msg);
                    break;

                    case "danger":
                    toastr.error(msg)
                    break;

                    case "info":
                    toastr.info(msg)
                    break;
                    
                    case "warning":
                    toastr.warning(msg)
                    break;
                }
        }
        
        $(document).ready(function(){

            let msg_type="";
            let msg="";
            @if(Session::has('msg'))
            msg_type="{{Session::get('msg_type')}}";
            // alert();
            msg="{{Session::get('msg')}}";
            @endif

            if(msg!="")
            {
                switch(msg_type)
                {
                    case "success":
                    Swal.fire({
  title: "Good job!",
  text: msg,
  icon: "success"
});
                    break;

                    case "danger":
                    Swal.fire({
  title: "Oops...",
  text: msg,
  icon: "error"
});
                    break;

                    case "info":
                    toastr.info(msg)
                    break; 
                    
                    case "warning":
                    toastr.warning(msg)
                    break;
                }
            }





        });
        
        
    </script>
</body>
</html>

</body>
</html>
