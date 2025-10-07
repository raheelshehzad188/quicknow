<title>{{ $btags }} 03008856924</title>
    <meta name="description" content="{{ isset($product[0]->short_discriiption) ? (strlen($product[0]->short_discriiption) > 170 ? substr($product[0]->short_discriiption, 0, 140) : $product[0]->short_discriiption) : ''}}" />
    <meta property="keywords" content="<?php echo $brands[0]->keywords;?>">

@php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
@endphp
<meta property="og:site_name" content="Shop Pakistan" />
<link rel="canonical" href="{{ $actual_link; }}" />
<meta property="og:image" content="{{ url($product[0]->image_one) }}" />