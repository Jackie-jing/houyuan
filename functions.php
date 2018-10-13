<?php
$new_meta_boxes =
array(
  "description" => array(
    "name" => "_description",
    "std" => "这里填默认的网页描述",
    "title" => "网页描述:"),

  "keywords" => array(
    "name" => "_keywords",
    "std" => "这里填默认的网页关键字",
    "title" => "关键字:")
);

function new_meta_boxes() {
  global $post, $new_meta_boxes;

  foreach($new_meta_boxes as $meta_box) {
    $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

    if($meta_box_value == "")
      $meta_box_value = $meta_box['std'];

    // 自定义字段标题
    echo'<h4>'.$meta_box['title'].'</h4>';

    // 自定义字段输入框
    echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
  }
   
  echo '<input type="hidden" name="ludou_metaboxes_nonce" id="ludou_metaboxes_nonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function create_meta_box() {
  if ( function_exists('add_meta_box') ) {
    add_meta_box( 'new-meta-boxes', '自定义模块', 'new_meta_boxes', 'post', 'normal', 'high' );
  }
}

function save_postdata( $post_id ) {
  global $new_meta_boxes;
   
  if ( !wp_verify_nonce( $_POST['ludou_metaboxes_nonce'], plugin_basename(__FILE__) ))
    return;
   
  if ( !current_user_can( 'edit_posts', $post_id ))
    return;
               
  foreach($new_meta_boxes as $meta_box) {
    $data = $_POST[$meta_box['name'].'_value'];

    if($data == "")
      delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    else
      update_post_meta($post_id, $meta_box['name'].'_value', $data);
   }
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
//keywords discription end

//在后台启用缩略图选项
if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
}
    
//文章缩略图获取
function dm_the_thumbnail() {
global $post;
// 判断该文章是否设置的缩略图，如果有则直接显示
if ( has_post_thumbnail() ) {
echo '<a href="'.get_permalink().'">';
the_post_thumbnail();
echo '</a>';
} else { //如果文章没有设置缩略图，则查找文章内是否包含图片
$content = $post->post_content;
preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER); 
$n = count($strResult[1]);
if($n > 0){ // 如果文章内包含有图片，就用第一张图片做为缩略图
echo '<a href="'.get_permalink().'"><img src="'.$strResult[1][0].'" /></a>';
}else { // 如果文章内没有图片，则用默认的图片。
echo '<a href="'.get_permalink().'"><img src="'.get_bloginfo('template_url').'/images/thumbnail.jpg" /></a>';
}
}
}
add_theme_support('post-thumbnails');


//注册侧边栏,出现后台小工具
if ( function_exists('register_sidebar') ) {   
  register_sidebar(array(   
  'name'=>'侧边栏',   
  'before_widget' => '<div class="little-tools">',   
  'after_widget' => '</div>',   
  'before_title' => '<h2>',   
  'after_title' => '</h2>',   
   ));   
}  

//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
 
//输出缩略图地址 From wpdaxue.com
function post_thumbnail_src(){
    global $post;
  if( $values = get_post_custom_values("thumb") ) { //输出自定义域图片地址
    $values = get_post_custom_values("thumb");
    $post_thumbnail_src = $values [0];
  } elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
    $post_thumbnail_src = $thumbnail_src [0];
    } else {
    $post_thumbnail_src = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $post_thumbnail_src = $matches [1] [0];   //获取该图片 src
    if(empty($post_thumbnail_src)){ //如果日志中没有图片，则显示随机图片
      $random = mt_rand(1, 10);
      echo get_bloginfo('template_url');
      echo '/images/pic/'.$random.'.jpg';
      //如果日志中没有图片，则显示默认图片
      //echo '/images/default_thumb.jpg';
    }
  };
  echo $post_thumbnail_src;
}

// 评论代码

function aurelius_comment($comment, $args, $depth)
{
   $GLOBALS['comment'] = $comment; ?>
   <li class="comment" id="li-comment-<?php comment_ID(); ?>">
        <div class="gravatar"> 
          <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 64); } ?>
          <?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?> 
        </div>
        <div class="comment_content" id="comment-<?php comment_ID(); ?>">  
          <div class="clearfix">
              <?php printf(__('<cite class="author_name">%s</cite>'), get_comment_author_link()); ?>
              <div class="comment-meta commentmetadata">发表于：<?php echo get_comment_time('Y-m-d'); ?></div>
              &nbsp;&nbsp;&nbsp;<?php edit_comment_link('修改'); ?>
          </div>
          <div class="comment_text">
              <?php if ($comment->comment_approved == '0') : ?>
              <em>你的评论正在审核，稍后会显示出来！</em><br />
              <?php endif; ?>
              <?php comment_text(); ?>
          </div>
        </div>
<?php } ?>

<!-- 幻灯片 -->

