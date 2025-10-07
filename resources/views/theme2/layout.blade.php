<?php
use App\Models\Admins\Pages;
use App\Models\Admins\Setting;
$Site= Setting::where(['id'=>'1'])->first();
  ?>
  <html>
    <head>

<!-- Favicon  -->

    @if(isset($meta_file) && $meta_file)
    @include($meta_file) 
    @else
    
    @include('meta.default')
    @endif

   @if(isset($meta) && $meta)

    
@else
@if(isset($meta_file) && $meta_file != 'meta.brand' && $meta_file != 'meta.product_tag' && $meta_file != 'meta.brand_tag' && $meta_file != 'meta.page' && $meta_file != 'meta.blog_detail' )

@if(Session::has('title'))
    <title>{{Session::get('title')}} | {{$Site->site_title}}</title>
    @else
      <title>{{$Site->site_title}}</title>
      @endif
@endif
@endif

    <?php $Settings = Setting::where(['id'=>'1'])->get(); ?>
    @foreach($Settings as $Setting)
    <link rel="icon" type="image/x-icon" href="{{env('APP_URL')}}{{$Setting->logo1}}">
    <link rel="shortcut icon" href="{{env('APP_URL')}}{{$Setting->logo1}}" type="image/x-icon"/ >
    @endforeach
        <link rel="stylesheet" href="{{ $assets_url }}css/stylesheet.css">
        <link rel="stylesheet" href="{{ $assets_url }}css/responsive.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/d222f8242c.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    @include('theme2.header')
    @yield('content')
    @include('theme2.footer')
    <script src="{{ $assets_url }}js/ayanstore.js"></script>
    </body>
</html>
