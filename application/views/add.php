<?php
define('TITLE', '新增学生');
$_GET["nomenu"]='style="display:none"';
include 'header.php';

//print '<h2>编辑</h2>';
$path =base_url();
if (!is_administrator()) {
	print '<h2>拒绝访问</h2><p class="error">你没有权限访问此页面.</p> <->';
	print anchor($path.'ci/index.php','跳转到首页');
	include('footer.php');
	exit();
}
print '<form name="Form" action="add_stu" method="post" onsubmit="window.opener=null;window.close();">';
//print '<form name="Form" action="add_stu" method="post">';
?>

<div class='panel panel-success'><div class='panel-heading'><h3 class='panel-title'>新增学生</h3></div><div class='panel-body'>
<p><label>姓名 <input type="text" class="form-control" name="name"
	value="<?php echo set_value('name');?>" /></label></p>
<p><label>班级 <input type="text" class="form-control" name="class"
	value="<?php echo set_value('class');?>" /></label></p>
<p><label>编号<input class="form-control" type="text" name="no"
	value="<?php echo set_value('no');?>" /></label></p>
<?php

print ' <button type="submit" name="submit" class="btn btn-primary">提交</button></div>
	</form>';

include 'footer.php';
?>