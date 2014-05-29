<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <?php echo '<script src="'.base_url().'ci/static/js/jquery-1.11.0.js" ></script>' ?>
    <?php echo '<script src="'.base_url().'ci/static/js/bootstrap.min.js" ></script>' ?>
          <?php echo '<script src="'.base_url().'ci/static/js/dateinput.js" ></script>' ?>
    <?php echo link_tag('ci/static/css/bootstrap.css'); ?>
    <?php echo link_tag('ci/static/css/date_input.css'); ?>
    <title>
        <?php
        if (defined('TITLE')) {
            print TITLE;
        } else {
            print '史家小学科学排行榜';
        }
        ?>
    </title>
    
    
    
</head>

<body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation"  <?php 
 if(isset($_GET["nomenu"]) && !empty($_GET["nomenu"]))
	echo $_GET["nomenu"];
?>>
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b>科学门网站</b></a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://kexuemen.com/">科学门论坛</a></li>
            <li class="active"><a href="<?php print base_url().'ci/index.php'; ?>">排行榜</a></li>
            <li><a href="#contact">关于</a></li>
            <?php
            if (is_administrator()) {
       			print "<li class='dropdown'>";
                print "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>管理中心<b class='caret'></b></a>";
              	$path =base_url();
                print "<ul class='dropdown-menu'>
		                <li><a href='{$path}ci/index.php/score'>勋章管理</a></li>
		                <li><a href='{$path}ci/index.php/stu'>学生管理</a></li>
		                <li><a href='{$path}ci/index.php/discipline'>纪律编码管理</a></li>
		                 <li><a href='{$path}ci/index.php/discipline_record'>学生纪律管理</a></li>
                		<li class='divider'></li>
		             </ul>
		       </li>";
            }
            ?>
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
            <?php
            if (!is_administrator()) {
                 print '<a href ="'.base_url().'ci/index.php/login">登录</a>';
            } else {
                 print '<a href ="'.base_url().'ci/index.php/login/login_out">登出</a>';
            }
             ?>
            </li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
      
</div>

<script >

jQuery.extend(DateInput.DEFAULT_OPTS, {   
month_names: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],   
short_month_names: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"],   
short_day_names: ["一", "二", "三", "四", "五", "六", "日"],  
 dateToString: function(date) {  
    var month = (date.getMonth() + 1).toString();  
    var dom = date.getDate().toString();  
    if (month.length == 1) month = "0" + month;  
    if (dom.length == 1) dom = "0" + dom;  
    return date.getFullYear() + "-" + month + "-" + dom;  
  }  
  
});   
 
$(function() {   
	 
$(".biuuu1").date_input();   
 
   

});   
</script>
          

    