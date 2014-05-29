<?php
/**
 * Created by onnsai.
 * User: onnsai
 * Date: 14-3-27
 * Time: 下午2:13
 */
class V_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	/**
	 *
	 * 检索前50名学生总分数排名
	 */
	function getTotalRank($class='',$scoreid='') {
		
		$where='where 1=1 ';
		$showCount ="50";
		if($class){
			$where.=' and p.stu_class ='.$this->db->escape($class);
			$showCount="20";
		}
		if($scoreid){
			$where.=' and p.score_id ='.$this->db->escape($scoreid);
		}
		$sql="SELECT p.stu_name,
						p.stu_class,p.stu_id,
						sum(count) medalCount,
						case when count(score_id) >= (select count(id) from pre_scoretype) then
							sum(score_val * count) * (1+5*(MIN(count)*0.01))-ifnull(sum(d.dsp_score),0)
						else
							sum(score_val * count)-ifnull(sum(d.dsp_score),0)
						end score,
						max(case when score_id=1 then count else 0 end ) wolf,
						max(case when score_id=2 then count else 0 end ) aristotle,
						max(case when score_id=3 then count else 0 end ) edison,
						max(case when score_id=4 then count else 0 end ) bruno,
						max(case when score_id=5 then count else 0 end ) leifeng,
						max(case when score_id=6 then count else 0 end ) mlf,
						max(case when score_id=7 then count else 0 end ) ylp,
						max(case when score_id=8 then count else 0 end ) bianhe,
						max(case when score_id=9 then count else 0 end ) bole,
						max(case when score_id=10 then count else 0 end ) kongrong,
						max(case when score_id=11 then count else 0 end ) weizheng
					FROM pre_scorelog p
                    left join pre_disciplinelog d on p.stu_id=d.stu_id ".$where."
					group by  p.stu_name,
						p.stu_class,
						p.stu_id
					order by score desc
					limit 0,".$showCount;
		$query =$this->db->query($sql);
		unset($sql);
		return $query;
	}
	
	/**
	 * 
	 * 班级排行
	 */
	function GetBanJiPaiHang($sc=''){
		$where='';
		if ($sc){
			$where = " where score_id=".$this->db->escape($sc);
		}
		
		$sql="select A.stu_class,sum(A.score) CScore from (SELECT stu_name,
						stu_class,stu_id,
						sum(count) medalCount,
						case when count(score_id) >= (select count(id) from pre_scoretype) then
							sum(score_val * count) * (1+5*(MIN(count)*0.01))
						else
							sum(score_val * count)
						end score
					FROM pre_scorelog p ".$where."
					group by stu_name,
						stu_class,
						stu_id
) A
group by stu_class
order by sum(A.score) desc";
		$query = $this->db->query($sql);
		return $query;
	}
	/**
	 * 
	 * 获取所有班级信息
	 */
	function GetClassInfo(){
		$sql="SELECT stu_class from pre_scorelog
				GROUP BY stu_class ";
		$query =$this->db->query($sql);
		return $query;
	}
	/**
	 *
	 * 检索班级排名
	 * @param $quote_id
	 */
	function getRankByClass($class) {
		$sql="SELECT stu_name,stu_class,stu_id,count(score_id) medalCount,
					case when count(score_id) >= (select count(id) from pre_scoretype) then
					sum(score_val * count) * (1+5*(MIN(count)*0.01))
					else
					sum(score_val * count)
					end score
					FROM pre_scorelog p
					where stu_class = ".$class."
					group by stu_name,
					stu_class,
					stu_id
					order by sum(score_val * count) desc
					limit 0,50 ";
		$query =$this->db->query($sql);
		return $query;
	}

	/**
	 * 检索所有学生
	 * Enter description here ...
	 */
	function searchAllStu($name ='',$class='',$no='',$id=''){
		$sql ="select * from `pre_students` where 1=1 ";
		if ($name){
			$sql .= " and name like '%".$name."%'";
		}
		if($class){
			$sql .= " and class = ".$this->db->escape($class);
		}
		if($no){
			$sql .= " and no = ".$this->db->escape($no);
		}
		if($id){
			$sql .= " and id = ".$this->db->escape($id);
		}

		$query= $this->db->query($sql);
		return $query;
	}

	/**
	 * 检索学生包含勋章数目
	 * Enter description here ...
	 */
	function searchStuCount($name ='',$class='',$no='',$id=''){
		$sql ="select B.*,case when (A.SCount is null ) then 0 else A.SCount end as Scount from pre_students B left join
				(select sum(count) Scount,stu_id from pre_scorelog
				group by stu_id) A
				on B.id=A.stu_id where 1=1 ";
		if ($name){
			$sql .= " and B.name like '%".$name."%'";
		}
		if($class){
			$sql .= " and B.class = ".$this->db->escape($class);
		}
		if($no){
			$sql .= " and B.no = ".$this->db->escape($no);
		}
		if($id){
			$sql .= " and B.id = ".$this->db->escape($id);
		}

		$query= $this->db->query($sql);
		return $query;
	}

	/***
	 * 新建学生信息
	 */
	function save_stu($array) {
		$sql="insert into `pre_students` (`name`,`class`,`no`,`age`,`sumScore`) VALUES (".$this->db->escape($array['name']).",".$this->db->escape($array['class']).", ".$this->db->escape($array['no']).",0,0)";
		$query= $this->db->query($sql);
		return $query;
	}

	/***
	 * 更新学生信息
	 */
	function edit_stu($array) {
		// 更新基础表
		$sql="update `pre_students` set  name=".$this->db->escape($array['name'])." , class=".$this->db->escape($array['class'])." , no=".$this->db->escape($array['no'])." where id=".$this->db->escape($array['id']);
		$query= $this->db->query($sql);

		$updateLogSql = "update `pre_scorelog` set  stu_name=".$this->db->escape($array['name'])." , stu_class=".$this->db->escape($array['class'])." where stu_id=".$this->db->escape($array['id']);
		$query= $this->db->query($updateLogSql);
		// 更新记录表
		return $query;
	}

	/***
	 * 删除学生信息
	 */
	function delete_stu($array) {
		$sql="delete from  `pre_students` where id=".$this->db->escape($array['id']);
		$query= $this->db->query($sql);

		$sqlLog="delete from  `pre_scorelog` where stu_id=".$this->db->escape($array['id']);
		$query= $this->db->query($sqlLog);
		return $query;
	}

	/***
	 * 更新得分日志
	 */
	function updatelog($array){
		$isHave="select * from pre_scorelog where stu_id=".$this->db->escape($array['stu_id'])." and score_id=".$this->db->escape($array['score_id']);
		$query= $this->db->query($isHave);
		$result = $query->result_array();
		if ($result){
			
			// 进行更新操作
			$this->updateScore($array);
		}
		else{
			echo "charu";
			// 进行插入操作
			$this->insertScore($array);
		}
	}

	/***
	 * 更新分数记录操作
	 */
	function updateScore($array){
		$sql="update `pre_scorelog` set  count=".$this->db->escape($array['count'])." where stu_id=".$this->db->escape($array['stu_id'])." and score_id=".$this->db->escape($array['score_id']);
		$query= $this->db->query($sql);
		return $query;
	}

	/***
	 * 插入分数记录操作
	 */
	function insertScore($array){
		$sql="insert into
				 pre_scorelog
				 (stu_id,
				 stu_name,
				 stu_class,
				 score_id,
				 score_name,
				 score_val,
				 count,
				 score_oname)
 			select
				 a.id,
				 a.name,
				 a.class,
				 b.id,
				 b.name,
				 b.value,
				 {$array['count']} as 'count',
				 b.othername
			from pre_students a
			cross join pre_scoretype b 
		where a.id=".$this->db->escape($array['stu_id'])." and b.id=".$this->db->escape($array['score_id']);

				 $query= $this->db->query($sql);
				 return $query;
	}

	/**
	 *
	 * 根据人员取得勋章信息
	 * @param 人员id
	 */
	function getScoreInfo($id){
		$sql="SELECT A.*, case when B.count is null then 0 else B.count end count
			  FROM pre_scoretype A
			  left join pre_scorelog B 
			  	on A.id =B.score_id
			  	and B.stu_id=".$this->db->escape($id);
		$query = $this->db->query($sql);
		return $query;

	}

	/**
	 *
	 * 获取所有勋章类型
	 */
	function getAllScore(){
		$sql="SELECT *
			  FROM pre_scoretype A";
		$query = $this->db->query($sql);
		return $query;
	}
}
?>