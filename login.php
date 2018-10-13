<?php
/*
Template Name: 自定义登陆页面
Author:Jing Chengpeng
Houyuan URL:www.aihouyuan.com
*/
?>
<?php get_header(); ?>

<!-- 登录/注册 -->
<?php
global $wpdb,$user_ID;

if (!$user_ID) { //判断用户是否登录

  if($_POST){ //数据提交
    //We shall SQL escape all inputs
    $username = $wpdb->escape($_REQUEST['username']);
    $password = $wpdb->escape($_REQUEST['password']);
    $remember = $wpdb->escape($_REQUEST['rememberme']);
  
    if($remember){
      $remember = "true";
    } else {
      $remember = "false";
    }
    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $login_data['remember'] = $remember;
    $user_verify = wp_signon( $login_data, false ); 
    //wp_signon 是wordpress自带的函数，通过用户信息来授权用户(登陆)，可记住用户名
    
    if ( is_wp_error($user_verify) ) { 
      echo "<span class='error'>用户名或密码错误，请重试!</span>";//不管啥错误都输出这个信息
      exit();
    } else { //登陆成功则跳转到首页(ajax提交所以需要用js来跳转)
      echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";
      exit();
    }
  } else {
?>
	
<div class="container">
  <div class="row">
    <div class="col-md-8 hidden-sm hidden-xs">
      <!-- 只是为了站位 -->
    </div>
    <div class="col-md-4" id="myTab">
      <ul class="nav nav-tabs" >
        <a class="acitve myTab-logoin" href="#logo-on" data-toggle="tab">账号密码登录</a>
        <a class="pull-right" href="#rigister" data-toggle="tab">注册新用户</a></li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade in active" id="logo-on">
          <!-- 登录表单 -->
          <div class="logoin">
            <form action="" class="form">
              <div class="form-group">
                <label for="" class="sr-only">账户</label>
                <input type="email" class="form-control input-lg" placeholder="账户名">
              </div>
              <div class="form-group">
                <label for="" class="sr-only">密码</label>
                <input type="password" class="form-control input-lg" placeholder="密码">
              </div>
            </form>
            <div class="checkbox">
              <label for=""><input type="checkbox">记住密码</label>
              <span><a href="">忘记密码</a></span>
            </div>
            <div>
              <button type="submit" class="btn btn-primary btn-block btn-lg">登录</button>
            </div>
          </div>
        </div><!-- 登录表单end -->
        <div class="tab-pane fade" id="rigister">
          <!-- 注册表单 -->
          <div class="register">
            <form action="" class="form">
              <div class="form-group">
                <label for="" class="sr-only">用户名</label>
                <input type="text" class="form-control input-lg" placeholder="账户名">
              </div>
              <div class="form-group">
                <label for="" class="sr-only">邮箱</label>
                <input type="email" class="form-control input-lg" placeholder="密码">
              </div>
            </form>
            <div class="">
              <p>注册邮件将会发送给您</p>
            </div>
            <div>
              <button type="submit" class="btn btn-primary btn-block btn-lg">注册</button>
            </div>
          </div><!-- 注册表单end -->
        </div>
      </div>
    </div>
  </div>
</div>











<!-- footer -->
<?php get_footer(); ?>