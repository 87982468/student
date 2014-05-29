<?php include 'header.php';?>

    <?php echo link_tag('ci/static/css/offcanvas.css'); ?>

<style>
	th.xz {color:#a5940e;font:12px/18px 'microsoft yahei'}
	.xz {color:#cc3524;font:18px/20px 'microsoft yahei' ;text-align:right}
	.zf {color:#d7a100;font:16px/20px 'microsoft yahei' ;text-align:right}
	td,th{font:15px/20px 'microsoft yahei';}
	
	td.cc{border-style: solid ;
		   border-width:1px 0 0 0;
		   border-color:#dddddd ;
		   height:35px
	}
	tbody.cc{height:50px;
	text-align:center;
	
	}
	th.cc{height:35px;
	font:18px/20px 'microsoft yahei';
	text-align:center;
	background-color:#b01f24;
	color:#f0d278}
	.cla1{background-image: url(<?php echo base_url();?>ci/static/img/1.png);background-size:contain;}
	.cla2{background-image: url(<?php echo base_url();?>ci/static/img/2.png);background-size:contain;}
	.cla3{background-image: url(<?php echo base_url();?>ci/static/img/3.png);background-size:contain;}
	.em1{display:none}
	.em2{display:none}
	.em3{display:none}
	
	ul.class{padding:0; margin: 0 auto ; list-style:none; width:100%;}
	table,ul .clsS{border-style: solid ;
		   border-width:1px;
		   border-color:#dddddd ;
		   border-radius: 3px;
		   width:100%}
	ul{list-style:none;}
	li.class{
		   line-height: 2em;
		   overflow: hidden;
		   width:60px; height:30px;
		   margin:10px; float:left; 
		   position:relative;
		   text-align:center;
		   border-style: solid ;
		   border-width:1px;
		   border-color:#66AAE6 ;
		   border-radius: 20px;}
	li.cccc{
		   border-color:#66AAE6 ;
		   width:110px; }
	li.class:hover{background-color:#dadada}
</style>

    <div class="container">
    <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
            <a name="zpm" href="<?php echo base_url().'ci/index.php';?>" onclick="showclass('zpm','');" class="list-group-item active">总排名</a>
            <a name="bjpm" href="?cc=1" onclick="showclass('bjpm','classmode');" class="list-group-item">班级排名</a>
            <a name="dxpm" href="?sc=1" onclick="showclass('dxpm','scoremode');" class="list-group-item">单项排名</a>
          </div>
          <div class="list-group" style='position:relative;top:100px'>
            <table class='clsS'>
            	<thead>
            		<tr>
            		<th class='cc' colSpan="4">
            		 <b style="color:white"><?php 
            		 	if ($sc){
	            		 	$arr = getArrayItem($scoreQuerry,'id',$sc);
	            			print "最佳".$arr["othername"];	
            		 	}
            		?></b>
            		班级排名
            		</th>
            		</tr>
            	</thead>
            	<tbody class='cc'>
            	<?php 
            	$count = 1;
            	foreach($bjph as $bj){
            	print "
	            	<tr>
	            	<td class='cc'>
	            	<B>第".daxie($count)."名</B>
	            	<td class='cc'> {$bj['stu_class']}班
	            	</td>
	            	<td class='cc zf'>".ceil($bj['CScore'])."分
	            	</td>
	            	</tr>";
            	$count += 1;
            	}
	            	?>
            	</tbody>
            </table>
          </div>
     </div>
    <div class="col-xs-12 col-sm-9">
    <ul id='classmode' class='class' style="display:none">
    <?php
    	foreach ($classinfo as $class){
    		$style ='';
    		if($cc == $class['stu_class']){
    			$style = "style='background-color:#C4D9EB'";
    		}
    		print "<li class='class'".$style." ><a href='?cc={$class['stu_class']}'>{$class['stu_class']}班</a></li>";
    	}
    ?>
    </ul>
    <ul id='scoremode' class='class' style="display:none" >
    <?php
    	foreach ($scoreQuerry as $score){
    		$style ='';
    		if($sc == $score['id']){
    			$style = "style='background-color:#C4D9EB'";
    		}
    		print "<li class='class cccc' {$style} ><a style='color:#428bca' href='?sc={$score['id']}'>{$score['name']}</a></li>";
    	}
    ?>
    </ul>
    <table class='table'>
	    <thead> 
		    <tr>
			    <th style="width:35px">排名</th>
			    <th>分数</th>
			    <th>学生姓名</th>
			    <th>班级</th>
			    <th class="xz">小狼</th>
			    <th class="xz">亚里士多德</th>
			    <th class="xz">爱迪生</th>
			    <th class="xz">布鲁诺</th>
			    <th class="xz">雷锋</th>
			    <th class="xz">梅兰芳</th>
			    <th class="xz">袁隆平</th>
			    <th class="xz">卞和</th>
			    <th class="xz">伯乐</th>
			    <th class="xz">孔融</th>
			    <th class="xz">魏征</th>
		    </tr> 
	    </thead> 
    <tbody>
    
<?php
			$mc = 1;
            foreach ($rows as $row) {
                print "<tr><td class='cla{$mc}'><em class='em{$mc}'>{$mc}</em></td>
                <td class='xz'>".ceil($row['score'])."</td>
                <td>{$row['stu_name']}</td>
                <td>{$row['stu_class']}</td>
                <td >{$row['wolf']}</td>
                <td >{$row['aristotle']}</td>
                <td >{$row['edison']}</td>
                <td >{$row['bruno']}</td>
                <td >{$row['leifeng']}</td>
                <td >{$row['mlf']}</td>
                <td >{$row['ylp']}</td>
                <td >{$row['bianhe']}</td>
                <td >{$row['bole']}</td>
                <td >{$row['kongrong']}</td>
                <td >{$row['weizheng']}</td>";
                print '</tr>';
                $mc += 1;
            }
?>
           </tbody></table>
<?php include 'footer.php';?>
</div>
<script type="text/javascript">
<!--

function menuChange(zpm){

	var menulist = $('.list-group-item');
	menulist.removeClass();
	menulist.addClass('list-group-item');
	
	elenanme='a[name='+zpm+']';
	$(elenanme).removeClass();
	$(elenanme).addClass('list-group-item active');
}

function showclass(zpm,block){
	$("#classmode").css('display','none');
	$("#scoremode").css('display','none');
	if (block){
		var name="#"+block;
		$(name).css('display','block');
	}
	menuChange(zpm);
}

<?php
if ($cc){
	print "showclass('bjpm','classmode');";
	
} 
if ($sc){
	print "showclass('dxpm','scoremode');";
}
?>
//-->
</script>
</div>