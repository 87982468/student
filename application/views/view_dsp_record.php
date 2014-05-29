<?php
define('TITLE', '学生纪律管理');
define('HTITLE', '学生纪律管理');
include 'header.php';

if (!is_administrator()) {
    print '<h2>拒绝访问</h2><p class="error">你没有权限访问此页面.</p> <->';
    print anchor(base_url().'ci/index.php','跳转到首页');
    include('footer.php');
    exit();
}
?>
<div class="jumbotron" id="container" style="width:1200px;margin:20px auto 30px">
    <h2>  <?php
        if (defined('HTITLE')) {
            print HTITLE;
        } else {
            
        }
        ?></h2>
    <!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    
    <form id="viewForm" class="form-signin" role="form" action=<?php echo "\"".base_url()."ci/index.php/discipline_record/search\"";?> method="post">
  

     
            
   <?php  print "<div class='panel panel-success'><div class='panel-heading'><h3 class='panel-title'>条件</h3></div><div class='panel-body'>";
print "<input type='input'  name='dspName' style='width:150px;display:inline' class='form-control' placeholder='纪律管理 ' value='{$dspName}' > ";
print "<input type='input'  name='stuName' style='width:150px;display:inline' class='form-control' placeholder='学生姓名' value='{$stuName}' > ";
print "<input type='input'  name='starttime' style='width:150px;display:inline' class='form-control biuuu1' placeholder='开始时间 (yyyy-MM-dd)' value='{$starttime}' > - ";
print "<input type='input'  name='endtime' style='width:150px;display:inline' class='form-control biuuu1' placeholder='结束时间 (yyyy-MM-dd)' value='{$endtime}' > ";
echo nbs(3);
print "<button type='submit' name='btnSearch' class='btn btn-primary'>检索</button>";
//print "<button type='button' name='btnAdd' style='float:right' onclick='gotoAdd();' class='btn btn-info' >新增</button>";
print "</div></div>";


// 内容信息
print "<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>纪律信息</h3>

</div><div class='panel-body'>";
print "<table class='table'>"; 
print " <thead> <tr> <th>学生</th> <th>班级</th><th>时间</th><th>纪律名称</th><th>违纪说明</th><th>扣分</th><th>编辑</th><th>删除</th></thead> <tbody>";

foreach ($rows as $row) {
    print "<tr ><td>{$row['stu_name']}</td><td>{$row['stu_class']}</td><td>{$row['opt_time']}</td><td>{$row['dsp_name']}</td><td>{$row['dsp_memo']}</td><td>{$row['dsp_score']}</td>";
print "<td><a href=\"javascript:gotoEdit({$row['id']});\" >编辑</a> </td>";
print "<td><a href=\"".base_url()."ci/index.php/discipline_record/delete?id={$row['id']}\"  onclick='return gotoDelete();' >删除</a> </td></tr>";
}
print "</tbody></table>";
print "</div> </div>";
?>
    </form>
    </div>

<?php 


include 'footer.php';
?>


<script type="text/javascript">
	function gotoEdit(id){ 
	//	var w=window.open(); 
	//	setTimeout(function(){ 
	//	w.location="stu/edit"; 
	//	w.height=100;
	//	w.width=400;
	//	}, 1); 
		
		var iWidth =400;
		var iHeight=500;
		var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;   
		var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;
		// iWidth 弹出窗口的宽度   
		// iHeight 弹出窗口的高度      
	  　　//window.open("stu/edit",   "学生信息编辑",   "height=800,   width=400,   toolbar   =no,   menubar=no,   scrollbars=no,   resizable=no,   location=no,   status=no")   //写成一行
	  	window.showModalDialog("<?php echo base_url();?>ci/index.php/discipline_record/edit?id="+id,"编辑",'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
	  	
	  	$('#viewForm').submit();
	  	//window.location.reload();  
		return true; 
	}
	 
	function gotoDelete(){
		return confirm('删除是不可恢复的，你确认要删除吗？');
		
	}
	
	function gotoAdd(){
		
		var iWidth =400;
		var iHeight=500;
		var iTop = (window.screen.height-30-iHeight)/2; //获得窗口的垂直位置;   
		var iLeft = (window.screen.width-10-iWidth)/2; //获得窗口的水平位置;
		// iWidth 弹出窗口的宽度   
		// iHeight 弹出窗口的高度      
	  　　//window.open("stu/edit",   "学生信息编辑",   "height=800,   width=400,   toolbar   =no,   menubar=no,   scrollbars=no,   resizable=no,   location=no,   status=no")   //写成一行
	  	window.showModalDialog("<?php echo base_url();?>ci/index.php/discipline_record/add","新增",'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
	  	
	  	$('#viewForm').submit();
	  	//window.location.reload();  
		return true; 	
	}
</script>