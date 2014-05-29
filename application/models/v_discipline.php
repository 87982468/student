<?php
class V_discipline extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function GetdisciplineInfo(){
		$sql="SELECT id,dsp_name from pre_discipline
				order BY id ";
		$query =$this->db->query($sql);
		return $query;
	}

	function  Insert($array)
	{

		if($array['id']<>0)
		{
		/*// 更新基础表
		$sql="update pre_discipline set dsp_name=".$this->db->escape($array['name'])." where id=".$this->db->escape($array['id']);

		$query= $this->db->query($sql);

		// 更新记录表
		return $query;*/
			   $this->update($array);
		 
		}
		else{
			$sql="insert into `pre_discipline` (`dsp_name`) VALUES (".$this->db->escape($array['name']).")";
			$query= $this->db->query($sql);
			return $query;
		}
		 

	}

	function searchAll($name =''){
		$sql ="select * from `pre_discipline` where 1=1 ";
		if ($name){
			$sql .= " and dsp_name like '%".$name."%'";
		}
		$sql .=" order by dsp_name";
		$query= $this->db->query($sql);
		return $query;
	}

	function delete($id =''){

		$sql ="delete   from `pre_discipline` where id= ".$id;
			
		$query= $this->db->query($sql);
		return $query;
	}

	function update($array){

// 更新基础表
		$sql="update pre_discipline set dsp_name=".$this->db->escape($array['name'])." where id=".$this->db->escape($array['id']);

		$query= $this->db->query($sql);


		// 更新记录表
		return $query;
	}

	function search($name='',$id=''){
		$sql="SELECT id,dsp_name from pre_discipline
		where 1=1";
		if($name)
		$sql .= " and dsp_name =".$name;
		if($id)
		$sql .= " and id = ".$id;
			
		$query =$this->db->query($sql);
		return $query;
	}
}
?>