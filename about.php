<?php
/*
Template Name: 关于我们
Author:Jing Chengpeng
Houyuan URL:www.aihouyuan.com
*/
?>
<?php get_header(); ?>

<!-- 登录/注册 -->
<div class="container">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="about-us">
        <ul class="nav nav-pills">
          <li class="about-us-item">
            <a href="">关于后园</a>
          </li>
          <li class="about-us-item">
            <a href="">联系后园</a>
          </li>
          <li class="about-us-item">
            <a href="">加入后园</a>
          </li>
          <li class="about-us-item">
            <a href="">友情链接</a>
          </li>
          <li class="about-us-item">
            <a href="">商务合作</a>
          </li>
        </ul>
        <p class="cut-line"></p>
          <?php while (have_posts()) : the_post(); ?>
            　<?php the_content(); ?>
          <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>












<!-- footer -->
<?php get_footer(); ?>