<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php if ( is_home() ) {
        bloginfo('name'); echo " - "; bloginfo('description');
    } elseif ( is_category() ) {
        single_cat_title(); echo " - "; bloginfo('name');
    } elseif (is_single() || is_page() ) {
        single_post_title();
    } elseif (is_search() ) {
        echo "搜索结果"; echo " - "; bloginfo('name');
    } elseif (is_404() ) {
        echo '页面未找到!';
    } else {
        wp_title('',true);
    } ?></title>
  </title>
	<meta name="viewport" content="device-width,initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <!-- 给每个页面加keywords和discription -->
  <?php
if (is_single()) {
  // 自定义字段名称为 description_value
  $description = get_post_meta($post->ID, "_description_value", true);

  // 自定义字段名称为 keywords_value
  $keywords = get_post_meta($post->ID, "_keywords_value", true);

  // 去除不必要的空格和HTML标签
  $description = trim(strip_tags($description));
  $keywords = trim(strip_tags($keywords));

  echo '<meta name="description" content="'.$description.'" />
<meta name="keywords" content="'.$keywords.'" />';
}

?>
</head>
<!-- 刷新缓存 -->
<?php flush(); ?>
<body <?php body_class(); ?>>
<nav class="navbar navbar-default" role="navigation">
  <div class="container container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand " href="index.html">
        <img src="<?php bloginfo('template_url'); ?>/images/logo.png" class="logo" alt="后园">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav nav-tabs">
        
        
        <li class="active" <?php if (is_home()) { echo 'class="current"';} ?>><a title="<?php bloginfo('name'); ?>"  href="<?php echo get_option('home'); ?>/">首页</a></li>
         <?php
            $currentcategory = '';

            // 以下这行代码用于在导航栏添加分类列表，
            // 如果你不想添加分类到导航中，
            // 请删除此部分代码
            if  (is_category() || is_single()) {
                $catsy = get_the_category();
                $myCat = $catsy[0]->cat_ID;
                $currentcategory = '&current_category='.$myCat;
            }
            wp_list_categories('depth=1&title_li=&show_count=0&hide_empty=0&child_of=0'.$currentcategory);

            // 以下这行代码用于在导航栏添加页面列表
            // 如果你不想添加页面到导航中，
            // 请删除此部分代码
            // wp_list_pages('depth=1&title_li=&sort_column=menu_order');
        ?>   
      </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="搜索一下">
        </div>
       <button type="submit" class="btn btn-default">搜索</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php bloginfo('url'); ?>/login">登录</a></li>
        <li><a href="<?php bloginfo('url'); ?>/about">关于后园</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>