

 <title><?php echo $blogs_detail->title;?></title>
   
    <meta name="description" content="<?php echo $blogs_detail->description;?>">
    <meta property="keywords" content="<?php echo $blogs_detail->keywords;?>">
   <meta property="og:site_name" content="Shop Pakistan" />
<meta property="og:title" content="<?php echo $blogs_detail->title;?>">

<meta property="og:description" content="<?php echo $blogs_detail->description;?>">

<meta property="og:url" content="{{ url('/blog/'.$blogs_detail->slug); }}">
<link rel="canonical" href="{{ url('/blog/'.$blogs_detail->slug); }}" />
<meta property="og:type" content="Ecommerce Website">



