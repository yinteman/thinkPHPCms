<?php 

/**
* 后台管理的model
*/
namespace Common\Model;
use Think\Model;


class AdminModel extends Model
{
	
	public function getAdminInfo($username){
		$array=M('admin')->where("username='{$username}'")->find();
		return $array;

	}
}













 ?>