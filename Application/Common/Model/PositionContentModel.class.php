<?php 
namespace Common\Model;
use Think\Model;

/**
* 推荐位内容mODEL
*/
class PositionContentModel extends Model
{
	
	public function add($data){
       if (!$data || !is_array($data)) {
               return 0;
       }
       return M('position_content')->data($data)->add();
	}
	public function select($condition=array()){
		$condition['status']=array('neq',-1);
		return M('position_content')->where($condition)->order('listorder desc,id')->select();
	}
	public function selectById($condition=array()){
		$condition['status']=array('neq',-1);
		return M('position_content')->where($condition)->find();
	}
	public function updata($condition=array(),$data){
		
		return M('position_content')->where($condition)->save($data);
	}


}




















 ?>