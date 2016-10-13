<?php 
namespace Common\Model;
use Think\Model;

/**
* 推荐位Model层
*/
class PositionModel extends Model
{
	
	function select(){
		$condition['status']=array('neq',-1);
		return M('position')->where($condition)->select();
	}
	function getRowsById($id){
		if (!$id|| !is_numeric($id)) {
			return 0;
		}
		$condition['id']=$id;

		return M('position')->where($condition)->find();
	}
	function add($data){
		$data['create_time']=time();
		return M('position')->data($data)->add();
	}
	function updata($id,$data){
		if (!$id|| !is_numeric($id)) {
			return 0;
		}
		$condition['id']=$id;

		return M('position')->where($condition)->save($data);

	}
}



























 ?>