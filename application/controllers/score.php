<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Score extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('V_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->V_model->searchStuCount();
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
	        "name"=>"",
	        "class"=>"",
			"no"=>""
        );
        $this->load->view('view_Score',$data);
        unset($data);
	}
	function search()
	{
		// 获取条件
		$name=$this->input->post('name');
		$class=$this->input->post('class');
		$no=$this->input->post('no');

		// 进行检索
		$query=$this->V_model->searchStuCount($name,$class,$no);
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
	        "name"=>$name,
	        "class"=>$class,
			"no"=>$no
		);
		$this->load->view('view_Score',$data);
        unset($data);
	}
	
	function edit() {
		$id=intval($this->input->get('id'));		// 进行检索
		$query=$this->V_model->getScoreInfo($id);
		
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
			"id"=>$id
		)
		;
		$this->load->view("editScore",$data);
        unset($data);
	}
	
	function edit_submit() {
		// 获取所有勋章
		$query = $this->V_model->getAllScore();
		$rows = $query->result_array();
		foreach ($rows as $row){
			$array = array(
			"stu_id"=>$this->input->post('stu_id'),
			"score_id"=>$row['id'],
			"count"=>intval($this->input->post($row['id'])),
			);
			$this->V_model->updatelog($array);
        	unset($array);
		}
		$this->load->view("closeself");

	}



}
?>