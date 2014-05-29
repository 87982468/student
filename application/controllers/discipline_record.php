<?php
class Discipline_Record extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		header('Content-type:text/html; charset=utf-8');
		date_default_timezone_set('Asia/Shanghai');

		$this->load->model('M_dsp_record');
		$this->load->model('V_model');
		$this->load->model('V_discipline');
		$this->load->library('form_validation');
	}

	function index()
	{

		$query=$this->M_dsp_record->GetAllRecordInfo();
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
	        "stuName"=>"",
		  	"dspName"=>"",
		"starttime"=>"",
		"endtime"=>"",
		);
		$this->load->view('view_dsp_record',$data);
	}
	function add()
	{
		//学生编码表ID
		$id=intval($this->input->get('id'));
		//判断
		if($id){


			$stuResult=$this->V_model->searchAllStu('','','',$id);
			$stuRos=$stuResult->result_array();

			$query=$this->V_discipline->searchAll('');
			$rows=$query->result_array();
			//登錄人信息
			$session_id = $this->session->userdata('lq');

			$data=array( "stuName"=>$stuRos[0]['name'],
		  	"dspName"=>"",
		"time"=>"",
		"memo"=>"",
		"score"=>"",
		"id"=>"",
		"stu_id"=>$stuRos[0]['id'],
		"dsp_id"=>"",
		"stu_class"=>$stuRos[0]['class'],
		"opr_id"=>$session_id,
		"row"=>$rows,
			);
			//$this->load->view("test",$data);
			$this->load->view("edit_dsp_record",$data);
		}else {

		}
	}
	function edit()
	{
		$id=intval($this->input->get('id'));



		//查违纪编码表
		$query=$this->V_discipline->searchAll('');
		$rows=$query->result_array();
		//查违纪记录表
		$result=$this->M_dsp_record->search('','','','',$id);

		$resultRow=$result->result_array();


		/*	$data=array("id"=>$id,"rows"=>$resultRow,"name"=>$resultRow[0]['stu_name']);
		 $this->load->view("test",$data);*/

		//登錄人信息
		$session_id = $this->session->userdata('lq');

			
		$data=array( "stuName"=>$resultRow[0]['stu_name'],
		  	"dspName"=>$resultRow[0]['dsp_name'],
		"time"=>$resultRow[0]['opt_time'],
		"memo"=>$resultRow[0]['dsp_memo'],
		"score"=>$resultRow[0]['dsp_score'],
		"id"=>$resultRow[0]['id'],
		"stu_id"=>$resultRow[0]['stu_id'],
		"dsp_id"=>$resultRow[0]['dsp_id'],
		"stu_class"=>$resultRow[0]['stu_class'],
		"opr_id"=>$session_id,
		"row"=>$rows,
		);
		$this->load->view("edit_dsp_record",$data);
	}
	function add_edit_record()
	{
		
		
		
		$dsp_name=$this->input->post('dsp_name');
		$stu_name=$this->input->post('stu_name');
		$time=$this->input->post('time');
		$memo=$this->input->post('memo');
		$score=$this->input->post('score');
		$id=intval($this->input->post('id'));
		$dsp_id=intval($this->input->post('dsp_id'));
		$stu_id=intval($this->input->post('stu_id'));
		$stu_class=intval($this->input->post('stu_class'));

		$user = $this->session->userdata('lq');
		$data=array(
        "dsp_name"=>$dsp_name,
		"stu_name"=>$stu_name,
		"opt_time"=>$time,
		"dsp_memo"=>$memo,
		"dsp_score"=>$score,
		"id"=>$id,
		"stu_id"=>$stu_id,
		"dsp_id"=>$dsp_id,
		"stu_class"=>$stu_class,
		"opr_id"=>$user
		);

	
		
		//$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		  
		//$this->load->view('test',$data);
 
		
	 	 
			//登錄人信息

			//$this->load->view('test',$data);

		$result=$this->M_dsp_record->save($data);
		//$this->load->view('test',$result);
			unset($data);

		
		$this->load->view("closeself");
	}

	function  search()
	{
		// 获取条件
		$dspname=$this->input->post('dspName');
		$stuName=$this->input->post('stuName');
		$starttime=$this->input->post('starttime');
		$endtime=$this->input->post('endtime');


		// 进行检索
		$query=$this->M_dsp_record->search($dspname,$stuName,$starttime,$endtime,'');
		$rows = $query->result_array();
		$data=array(
           "rows"=>$rows,
	        "stuName"=>$stuName,
		  	"dspName"=>$dspname,
		"starttime"=>$starttime,
		"endtime"=>$endtime,
		);
		$this->load->view('view_dsp_record',$data);
		unset($data);
	}

	function  delete()
	{
		$id=intval($this->input->get('id'));
			
		$this->M_dsp_record->delete($id);
		//重新查詢
		// 获取条件
		$dspname=$this->input->post('dspName');
		$stuName=$this->input->post('stuName');
		$starttime=$this->input->post('starttime');
		$endtime=$this->input->post('endtime');
		// 进行检索
		$query=$this->M_dsp_record->search($dspname,$stuName,$starttime,$endtime,'');
		$rows = $query->result_array();
		$data=array(
           "rows"=>$rows,
	        "stuName"=>$stuName,
		  	"dspName"=>$dspname,
		"starttime"=>$starttime,
		"endtime"=>$endtime,
		);
		$this->load->view('view_dsp_record',$data);

		unset($data);
			
	}


}
?>