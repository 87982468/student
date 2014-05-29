<?php
    //定义主题常量
    define('TITLE', '管理员登录');
    define('HTITLE',' ');
    include 'header.php';
?>
<?php echo link_tag('ci/static/css/offcanvas.css'); ?>
<?php
    if (is_administrator()) {
             print '<p style="font-size:20px">欢迎进入学生管理中心页面。请选择管理中心，进行数据管理。</p>';
    } else {
     ?>

      <div class="container" style="width:400px">
   <form class="form-signin" role="form" action=<?php echo "\"".base_url()."ci/index.php/login/check_login\"";?> method="post">
        <h1 class="form-signin-heading">管理员登陆</h2>
       <!--set_value:重新填充表单 form_error:单独显示错误信息-->
       
        <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="用户名:" required autofocus>
<!--        <p><label>用户名:<input type="text" name="email" value="<?php //echo set_value('email'); ?>"/></label></p>-->
       <?php echo form_error('email'); ?>
        <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" required>
<!--        <p><label>密码:<input type="password" name="password" value="<?php //echo set_value('password'); ?>"/></label></p>-->
       <?php echo form_error('password'); ?>
       <br/>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
<!--        <p><input type="submit" name="submit" value="登录" /></p>-->
   </form>
    <?php }?>
    </div>
<?php include 'footer.php';?>