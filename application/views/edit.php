<?php
define('TITLE', '编辑学生信息');
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
print '<form name="Form111" action="edit_submit" method="post" onsubmit="window.opener=null;window.close();">';
?>

<div class='panel panel-success'><div class='panel-heading'><h3 class='panel-title'>学生信息编辑</h3></div><div class='panel-body'>
<p><label>姓名 <input type="text" class="form-control" name="name"
	value="<?php echo $rows['name'];?>" /></label></p>
<p><label>班级 <input type="text" class="form-control" name="class"
	value="<?php echo $rows['class'];?>" /></label></p>
<p><label>编号<input class="form-control" type="text" name="no"
	value="<?php echo $rows['no'];?>" /></label></p>
<?php

print ' <input type="hidden" name="id" value="' . $rows['id'] . '" />
	    <button type="submit" name="submit" onclick="closeSelf();" class="btn btn-primary">更新</button></div>
	</form>';

include 'footer.php';
?>