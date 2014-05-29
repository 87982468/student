<?php
class Discipline extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		header('Content-type:text/html; charset=utf-8');
		date_default_timezone_set('Asia/Shanghai');

		$this->load->model('V_discipline');
		$this->load->library('form_validation');

	}
	function index() {

		$query=$this->V_discipline->GetdisciplineInfo();
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
	        "name"=>""
	        );
	        $this->load->view('view_discipline',$data);

	        unset($data);
	}

	function  add()
	{
		try {
	 
		if(isset($_GET['id']))
		{
			//编辑
			 $id=intval($this->input->get('id'));
			 
	     	$query= $this->V_discipline->search('',$id);
		   $rows = $query->row_array();
		  $data=array(
            "id"=>$rows['id'],
	        "name"=>$rows['dsp_name']
	        );
	      //$this->load->view("test",$data);
	        
		}
		else {
			//新增
		$data=array("name"=>"","id"=>"");
		}
		
		$this->load->view("edit_discipline",$data);
		}catch (Exception  $e)
		{
			show_error($e->getMessage(),$e->getCode(),$e->getMessage());
		}
	}
function  delete()
	{
		$id=intval($this->input->get('id'));
		 
		$this->V_discipline->delete($id);
		//重新查詢
		$query=$this->V_discipline->GetdisciplineInfo();
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
	        "name"=>""
	        );
	        $this->load->view('view_discipline',$data);

	        unset($data);
		 
	}
function  update()
	{
		 $name=$this->input->post('name');
		  $id=$this->input->post('id');
		$data=array("name"=>$name,"id"=>$id);
		$this->load->view("edit_discipline",$data);
		 
		 
	}
	function  add_discipline()
	{
	
	 $name=$this->input->post('name');
	 
	   
	$id=intval($this->input->post('id'));
	 $data=array("name"=>$name,"id"=>$id);
	 
	 //$this->load->view("test",$data);
  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$this->form_validation->set_rules('name', 'name', 'required');
			
		 
		if ($this->form_validation->run() == FALSE)
		{
			$data=array("id"=>$id);
			$this->load->view('test',$data);
		}
		else
		{

			$data=array(
                'name'=>$name,
			     'id'=>$id
			);
			$this->V_discipline->insert($data);
			unset($data);
			$this->load->view("closeself");

		}
	
		
	}
	
function search()
	{
		// 获取条件
		$name=$this->input->post('name');

		// 进行检索
		$query=$this->V_discipline->searchAll($name);
		$rows = $query->result_array();
		$data=array(
            "rows"=>$rows,
	        "name"=>$name
		);
		$this->load->view('view_discipline',$data);
        unset($data);
	}

}

?>