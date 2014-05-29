<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('V_model');
		header('Content-type:text/html; charset=utf-8');
		date_default_timezone_set('Asia/Shanghai');
	}
	public function index()
	{

		
		// 获取表单班级选项
        $cc=$this->input->get('cc');
        
        // 获取表单项目选项
        $sc=$this->input->get('sc');
        
        // 根据班级获取排名信息
        $query=$this->V_model->getTotalRank($cc,$sc);
        $rows = $query->result_array();
        
        // 班级排行信息获取
        $bjResult =$this->V_model->GetBanJiPaiHang($sc);
        $bjph =$bjResult->result_array(); 
        
        // 获取所有班级信息
        $class =$this->V_model->GetClassInfo();
        $classinfo = $class->result_array();
        
        // 获取所有勋章信息
        $allScore =$this->V_model->getAllScore();
        $scoreQuerry = $allScore->result_array();
        
        // 页面传值
        $data=array(
            "rows"=>$rows,
        	"classinfo"=>$classinfo,
        	"cc"=>$cc,
        	"sc"=>$sc,
        	"bjph"=>$bjph,
        	"scoreQuerry"=>$scoreQuerry
        );
		$this->load->view('index',$data);
		
		// 释放内存
		unset($data);
		unset($rows);
		unset($query);
	}


}
