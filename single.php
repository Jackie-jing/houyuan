<?php get_header(); ?>
<div class="container">
<div class="row">
  <div class="col-md-8">
  <!-- 主要内容部分占8格 -->
    <div class="container-fluid">
      <div class="row info-content">
        <div class="article-content-title">
          <h1><?php the_title(); ?></h1>
          <p class="auther"><a href="">&nbsp;荆承鹏</a>&nbsp;&nbsp;发表于&nbsp;&nbsp;<?php the_time('Y-m-d H:i:s') ?>&nbsp;&nbsp;<?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', '', '评论已关闭'); ?></p>
          <div class="single-content">
            <?php while (have_posts()) : the_post(); ?>
            　　　<?php the_content(); ?>
            <?php endwhile; ?>
          </div>
          <div class="article-content-btn">
            <a>
              <?php the_tags('标签', ' ', ''); ?>
            </a>
          </div>
        </div>
      </div>
<!-- 正文内容页底部广告 -->
      <div class="row ads">
          <img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/ad4.jpg" alt="">
        </div>
        <!-- 相关文章 -->
        <div class="row info-content hidden-xs" style="overflow:hidden ">
          <div class="hidden-xs related-title">
              <h2>相关文章</h2>
          </div>
          <!-- 相关文章 -->
               <?php
$post_num = 3;
$exclude_id = $post->ID;
$posttags = get_the_tags(); $i = 0;
if ( $posttags ) {
  $tags = ''; foreach ( $posttags as $tag ) $tags .= $tag->term_id . ',';
  $args = array(
    'post_status' => 'publish',
    'tag__in' => explode(',', $tags),
    'post__not_in' => explode(',', $exclude_id),
    'caller_get_posts' => 1,
    'orderby' => 'comment_date',
    'posts_per_page' => $post_num
  );
  query_posts($args);
  while( have_posts() ) { the_post(); ?>
    <li class="related_box"  >
    <div class="related_box_item">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
    <img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" />
    </a>
    </div>
    <div class="r_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank" rel="bookmark"><?php the_title(); ?></a></div>
    <div class="related-time"><?php the_time('Y/m/d') ?></div>
    </li>
  <?php
    $exclude_id .= ',' . $post->ID; $i ++;
  } wp_reset_query();
}
if ( $i < $post_num ) {
  $cats = ''; foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
  $args = array(
    'category__in' => explode(',', $cats),
    'post__not_in' => explode(',', $exclude_id),
    'caller_get_posts' => 1,
    'orderby' => 'comment_date',
    'posts_per_page' => $post_num - $i
  );
  query_posts($args);
  while( have_posts() ) { the_post(); ?>
  <li class="related_box"  >
    <div class="r_pic">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank">
    <img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>"/>
    </a>
    </div>
    <div class="r_title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank" rel="bookmark"><?php the_title(); ?></a></div>
  </li>
  <?php $i++;
  } wp_reset_query();
}
if ( $i  == 0 )  echo '<div class="r_title">没有相关文章!</div>';
?>
<!-- 相关文章end -->
            </div>

      <!-- 分页 -->
      <ul class="pager">
        <li class="previous"><?php previous_posts_link('&laquo;上一页', 0); ?></li>
        <li class="next"><?php next_posts_link('下一页&raquo;', 0); ?></li>
      </ul>
      <!-- 评论 -->
        <?php comments_template();?>
    </div>
  </div><!-- 左侧主要内容 -->
  <!-- 右侧内容 -->
  <!-- slider first ad -->
  <?php get_sidebar(); ?>
</div><!-- row end -->
</div><!-- container end  -->

	

<!-- footer -->
<?php get_footer(); ?>