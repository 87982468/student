<?php
define('TITLE', '编辑纪律信息');

include 'header.php';

//print '<h2>编辑</h2>';
$path =base_url();
if (!is_administrator()) {
	print '<h2>拒绝访问</h2><p class="error">你没有权限访问此页面.</p> <->';
	print anchor($path.'ci/index.php','跳转到首页');
	include('footer.php');
	exit();
}
print '<form name="Form" action="add_discipline" method="post" >';
?>

<div class='panel panel-success'>
<div class='panel-heading'>
<h3 class='panel-title'>纪律信息</h3>
</div>
<div class='panel-body'>
<p><label>纪律名称 </label>
 <?php echo form_error('name'); ?>
<input type="text" class="form-control" name="name"
	value="<?php echo $name; //echo  $name;?>" required /></p>

<?php

print ' <input type="hidden" name="id" value="'.$id.'" />
	    <button type="submit" name="submit"  onclick="seturl();" class="btn btn-primary">确定</button></div>
	</form>';

include 'footer.php';

?>



