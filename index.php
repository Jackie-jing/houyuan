<?php get_header(); ?>

<div class="container">
<div class="row">
  <div class="col-md-8">
  <div class="carousel carousel-main" id="slidershow" data-ride="carousel" data-interval="3000" data-wrap="true">
    <!-- 设置轮播顺序 -->
    <ol class="carousel-indicators">
      <li class="active" data-target="#slidershow" data-slide-to="0"></li>
      <li data-target="#slidershow" data-slide-to="1"></li>
      <li data-target="#slidershow" data-slide-to="2"></li>
    </ol>
    <!-- 设置轮播图片 -->
    <div class="carousel-inner">
      <div class="item active">
        <a href="#"><img src="<?php bloginfo('template_url'); ?>/images/heading1.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="<?php bloginfo('template_url'); ?>/images/heading2.jpg" alt=""></a>
      </div>
      <div class="item">
        <a href="#"><img src="<?php bloginfo('template_url'); ?>/images/heading3.jpg" alt=""></a>
      </div>
      <!-- 设置轮播图片控制器 -->
      <a href="#slidershow" role="button" data-slide="prev" class="left carousel-control">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a href="#slidershow" role="button" data-slide="next" class="right carousel-control">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
  </div>
  <!-- 主要内容部分占8格 -->
    <div class="container-fluid">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="row info-content">
        <div class="col-md-5 col-sm-5 col-xs-5">
          <div class="thumbnail-pic">
            <!-- 引入缩略图 -->
            <?php dm_the_thumbnail(); ?>
          </div>
        </div>
        <div class="col-md-7 col-sm-7 col-xs-7">
          <h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
          <p class="hidden-xs"><?php the_excerpt(); ?></p>
          <div class="time-tags">
            <span>文/&nbsp;<a href="">左小小</a></span>
            <span>&nbsp;<?php the_time('y-m-d') ?></span>
            <span>
              <?php the_tags('标签：', ', ', ''); ?>
            </span>
          </div>
        </div>
      </div>
        <?php endwhile; ?>
        <?php else : ?>
            糟糕，文章不见了！
        <?php endif; ?>

      <!-- 分页 -->
      <ul class="pager">
        <li class="previous"><?php previous_posts_link('&laquo;上一页', 0); ?></li>
        <li class="next"><?php next_posts_link('下一页&raquo;', 0); ?></li>
      </ul>
    </div>
  </div><!-- 左侧主要内容 -->
  <!-- 右侧内容 -->
<?php get_sidebar(); ?>
</div><!-- row end -->
</div><!-- container end  -->

	

<!-- footer -->
<?php get_footer(); ?>