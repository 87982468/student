<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: John
 * Date: 14-3-27
 * Time: 上午11:58
 */
/**检查用户是否为管理员
 * @param string $value 可选参数
 * return 返回一个布尔值
 */
function is_administrator($name='lq',$value='admin') {
	$CI =& get_instance();
	$session= $CI->session->userdata($name);
	if(!empty($session) && $session==$value) {
		return true;
	} else {
		return false;
	}
}
 
 
function daxie($number){
	$number=substr($number,0,2);
	$arr=array("零","一","二","三","四","五","六","七","八","九");
	if(strlen($number)==1){
		$result=$arr[$number];
	}else{
		if($number==10){
			$result="十";
		}else{
			if($number<20){
				$result="十";
			}else{
				$result=$arr[substr($number,0,1)]."十";
			}
			if(substr($number,1,1)!="0"){
				$result.=$arr[substr($number,1,1)];
			}
		}
	}
	return $result;
}

function getArrayItem($array,$itemname,$pipeiZhi){
	foreach($array as $arr){
		if($arr[$itemname] == $pipeiZhi){
			return $arr;
		}
	}
	return '';
}
 
?>