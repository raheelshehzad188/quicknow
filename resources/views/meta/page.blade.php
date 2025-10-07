
@foreach ($pages as $page) 
 <title><?php echo $page->seo_title;?></title>
   
    <meta name="description" content="<?php echo $page->seo_description;?>">
    <meta property="keywords" content="<?php echo $page->seo_keywords;?>">
<meta property="og:site_name" content="Shop Pakistan" />
<meta property="og:title" content="<?php echo $page->seo_title;?>">

<meta property="og:description" content="<?php echo $page->seo_description;?>">

<meta property="og:url" content="{{ url('/'.$page->slug); }}">
<link rel="canonical" href="{{ url('/'.$page->slug); }}" />
<meta property="og:type" content="Ecommerce Website">

 @endforeach

