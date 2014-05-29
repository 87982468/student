<?php

class M_dsp_record extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
function GetAllRecordInfo(){
		$sql="SELECT * from pre_disciplinelog
				order BY opt_time ";
		$query =$this->db->query($sql);
		return $query;
	}
	
	function insert($array)
	{
		 
	  $sql="INSERT INTO `pre_disciplinelog`( 
	  `dsp_id`,
	  `dsp_name`, 
	  `dsp_memo`, 
	  `dsp_score`,
	   
	   `opt_time`, 
	   `stu_class`, 
	   `stu_id`,
	    `stu_name`) VALUES ("
	  
	   .$this->db->escape($array['dsp_id'])
	  .",".$this->db->escape($array['dsp_name'])
	  .",".$this->db->escape($array['dsp_memo']).","
	  .$this->db->escape($array['dsp_score'])
	 // .",".$this->db->escape($array['opr_id'])
	  .","
	  .$this->db->escape($array['opt_time'])
	  .",".$this->db->escape($array['stu_class']).","
	  .$this->db->escape($array['stu_id'])
	  .",".$this->db->escape($array['stu_name']).")";
		$query= $this->db->query($sql);
		return $query;
	}
	function update ($array)
	{
		$sql="update pre_disciplinelog set dsp_id=".$this->db->escape($array['dsp_id'])
		.",dsp_name=".$this->db->escape($array['dsp_name'])
		.",dsp_memo=".$this->db->escape($array['dsp_memo'])
		.",dsp_score=".$this->db->escape($array['dsp_score'])
		.",opt_time=".$this->db->escape($array['opt_time'])
		//.",opr_id=".$this->db->escape($array['opr_id'])
		.",stu_id=".$this->db->escape($array['stu_id'])
		.",stu_name=".$this->db->escape($array['stu_name'])
		.",stu_class=".$this->db->escape($array['stu_class'])
		." where id=".$this->db->escape($array['id']);
		$query= $this->db->query($sql);
		return $query;
	}
	
	function save($array)
	{
		 
		if($array['id']<>0)
		{
		  //更新
		  $this->update($array);
		}else
		{
			//增加
			$this->insert($array);
		}
	}
	
	function  search($dspname='',$stuName='',$starttime='', $endtime='',$id='')
	{
	
		$sql="SELECT * from pre_disciplinelog where 1=1";
		//紀律
	 if($dspname)
	 $sql.=" and dsp_name like '%".$dspname."%'";
		 if($stuName)
	 $sql.=" and stu_name like '%".$stuName."%'";
		 if($starttime)
	 $sql.=" and opt_time >='".$starttime."'";
		 if($endtime)
	 $sql.=" and opt_time <='".$endtime."'";
		
	 if($id)
	 $sql.=" and id=".$id;
		
				$sql.=" order BY opt_time ";
		$query =$this->db->query($sql);
		return $query;
	}
	
	function delete($id='')
	{
		$sql ="delete   from `pre_disciplinelog` where id= ".$id;
			
		$query= $this->db->query($sql);
		return $query;
	}
}

?>