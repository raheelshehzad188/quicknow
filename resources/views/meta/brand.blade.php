 
<title><?php echo $brand->title ?> - Shop Pakistan</title>
    <meta name="description" content="{{ $brand->description }}">
    <meta property="keywords" content="<?php echo $brand->s_keywords;?>">
   <meta property="og:site_name" content="ShopPakistan.com.pk">
<meta property="og:title" content="<?php echo $brand->title;?>">

<meta property="og:description" content="{{ $brand->description }}">

<meta property="og:url" content="{{ url('brand/'.$brand->slug); }}">
<link rel="canonical" href="{{ url('brand/'.$brand->slug); }}" />
<meta property="og:type" content="Ecommerce Website">
