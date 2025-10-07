<title>{{ $tags }} - Shop Pakistan</title>
     <meta name="description" content="{{ isset($product[0]->short_discriiption) ? (strlen($product[0]->short_discriiption) > 170 ? substr($product[0]->short_discriiption, 0, 140) : $product[0]->short_discriiption) : ''}}" />

@php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
@endphp
<meta property="og:site_name" content="Shop Pakistan" />
<meta property="keywords" content="<?php echo preg_replace("/-/", " ", $product[0]->tags);?>">
<link rel="canonical" href="{{ $actual_link; }}" />
<meta property="og:image" content="{{ url($product[0]->image_one) }}" />