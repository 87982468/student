<?php
define('TITLE', '授予勋章');
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
print '<form name="Form111" action="edit_submit" method="post" >';
?>

<style>
ul {padding:0; margin: 0 auto ; list-style:none; width:100%;}
li {width:100px; height:200px; margin:10px; float:left; position:relative; text-align:center;}
sup {position:absolute; right:0px; font:22px/30px 'microsoft yahei'; text-shadow:0 0 2px 2px #fff; color:#cb00fe;}
.left {position:absolute; right:90px;}
img.ty {width:100px; height:140px; border-radius:50%;}
img.del {width:25px; height:25px; }
h5,p {margin:0; font:12px/20px 'microsoft yahei'; }
h5 {color:#28B3AC}
em {text-shadow:0 0 2px 2px #fff;color:#eb0000;font:16px/20px 'microsoft yahei';}
</style>

<script type="text/javascript">
function AddCount(filename,id,val){
	var sup = 'sup[name="s_'+filename+'"]';
	var label = "label[name='"+filename+"']"
	var input = 'input[name="'+id+'"]'

	// sup add num;
	$(sup).html(reckon($(sup).html(),val));

	// label +1
	$(label).html(parseInt($(label).html())+val);

	// hidden input +1
	$(input).val(parseInt($(input).val())+val);
	
}
function reckon(result,val){

	result = result.replace("+","");
	if (result=='') result=0;
	var sum =parseInt(result) + val;
	if(sum>0){
		return "+"+sum;
	}
	else if(sum<0){
		return sum;
	}

	return '';
		
}
function checkForm(){
	for(i=1;i<12;i++){
		var input = 'input[name="'+i+'"]'
		if(parseInt($(input).val())<0){
			alert("勋章数量不允许为负数！");
			return false;
		}
	}
	return true;
}

</script>
<div class='panel panel-success'><div class='panel-heading'><h3 class='panel-title'><button type="submit" name="submit" onclick="return checkForm();" class="btn btn-primary">勋章授予</button></h3></div><div class='panel-body'><ul>

<?php 
foreach($rows as $row){
	print "<li> <sup name='s_{$row['filename']}'></sup> ";
	print "<sup class='left'><img class='del' src='{$path}ci/static/img/del.png' onclick='AddCount(\"{$row['filename']}\",\"{$row['id']}\",-1)'></sup>";
	print "<img class='ty' src='{$path}ci/static/img/{$row['filename']}.png' onclick='AddCount(\"{$row['filename']}\",\"{$row['id']}\",1)'>";
	//print img("ci/static/img/{$row['filename']}.png",FALSE);
	print "<p>{$row['name']}：<span>{$row['value']}</span>分</p>
    <h5>已经获得<em><input type='hidden' name='{$row['id']}' value='{$row['count']}'/>
    <label name='{$row['filename']}'>{$row['count']}</label></em>个</h5>
  			</li>
	";
}

print "</ul>";

print ' <input type="hidden" name="stu_id" value="'.$id.'" />
	    </div>
	</form>';

include 'footer.php';
?>