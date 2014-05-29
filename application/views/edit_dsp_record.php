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
print '<form name="Form" action="add_edit_record" method="post" >';
?>

<div class='panel panel-success'>
<div class='panel-heading'>
<h3 class='panel-title'>学生纪律信息</h3>
</div>
<div class='panel-body'>
<p><label>纪律名称 </label>
 <?php


 print "<select  id='dspValue' onchange='SetDspID();' class='form-control' required >" ;

  foreach ($row as $rows) {
  	if($rows['id']==$dsp_id)
  	{
  	print "<option selected='selected' value={$rows['id']}> {$rows['dsp_name']}</option>";
  	}else
  	{
 print "<option value={$rows['id']}> {$rows['dsp_name']}</option>";
  	}
  }
 print "</select>";
 //disabled="disabled"
?>
</p>

<p><label>学生姓名</label><input type="text" class="form-control"    name="stu_name"
	value="<?php echo  $stuName;?>"   /></p>
	<p>	<label>班级</label><input type="text" class="form-control"    name="stu_class"
	value="<?php echo  $stu_class;?>" /></p>
	<p><label>时间</label><input type="text" class="form-control biuuu1" name="time"
	value="<?php 
	if($time)
	
	echo date("Y-m-d",strtotime($time)); 
	else 
	{
		date_default_timezone_set("PRC");
		echo date("Y-m-d"); 
	}
	?>" required /></p>
<p>	<label>违纪说明</label><input type="text" class="form-control" name="memo"
	value="<?php echo  $memo;?>" required /></p>
	<p>	<label>扣分</label><input type="text" class="form-control" name="score"
	value="<?php echo  $score;?>"  required/></p>
<?php
 
  
print ' <input type="hidden" name="id" value="'.$id.'" />
<input type="hidden" name="dsp_id" id="dsp_id" value="'.$dsp_id.'" />
<input type="hidden" name="stu_id"  value="'.$stu_id.'" />
<input type="hidden" name="dsp_name" id="dsp_name"  value="'.$dspName.'" />
 

	    <button type="submit" name="submit" onclick="SetDspID();"   class="btn btn-primary">确定</button></div>
	</form>';

include 'footer.php';

?>



<script>  





function SetDspID()
{
	
  var value=$("#dspValue").val();
  var text=$("#dspValue option:selected").text();
  $("#dsp_id").val(value);
  $("#dsp_name").val(text);
  
}


</script>  



