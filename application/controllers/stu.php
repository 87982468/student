<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stu extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('V_model');
		$this->load->library('form_validation');
	}

	function index(){
		$query=$this->V_model->searchAllStu();
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
        "name"=>"",
        "class"=>"",
		"no"=>""
        );
        $this->load->view('view_stu',$data);
        unset($data);
	}
	function search()
	{
		// 获取条件
		$name=$this->input->post('name');
		$class=$this->input->post('class');
		$no=$this->input->post('no');

		// 进行检索
		$query=$this->V_model->searchAllStu($name,$class,$no);
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
	        "name"=>$name,
	        "class"=>$class,
			"no"=>$no
		);
		$this->load->view('view_stu',$data);
        unset($data);
	}
	function add() {

		$this->load->view("add");
	}

	function add_stu() {
		$name=$this->input->post('name');
		$class=$this->input->post('class');
		$no=$this->input->post('no');
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('class', 'class', 'required');
		$this->form_validation->set_rules('no', 'no', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('add');
			 
		}
		else
		{
			$data=array(
                'name'=>$name,
                'class'=>$class,
                'no'=>$no
			);
			$this->V_model->save_stu($data);
        	unset($data);
        		 
		}
	}

	function edit() {
		$id=intval($this->input->get('id'));		// 进行检索
		$query=$this->V_model->searchAllStu('','','',$id);
		
		$rows = $query->row_array();
		$data=array(
            "rows"=>$rows
		)
		;
		$this->load->view("edit",$data);
        unset($data);
	}
	
	function edit_submit() {
		$id=intval($this->input->post('id'));
		$name=$this->input->post('name');
		$class=$this->input->post('class');
		$no=$this->input->post('no');
		
		$data=array(
                'id'=>$id,
                'name'=>$name,
                'class'=>$class,
                'no'=>$no
		);
		$this->V_model->edit_stu($data);
        unset($data);
	}

	function delete_stu() {
		$id=intval($this->input->get('id'));
		$data=array(
            'id'=>$id,
		);
		$this->V_model->delete_stu($data);
		redirect(base_url()."ci/index.php/stu/search");
	}

}
?>