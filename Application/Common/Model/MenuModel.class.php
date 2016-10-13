<?php 
namespace Common\Model;
use Think\Model;
/**
* 菜单管理
*/
class MenuModel extends Model
{
	//添加菜单
	public function addMenu($data=array()){
       if (!$data || !is_array($data)) {
       	return '';
       }
       return M('menu')->data($data)->add();
	}
	//获得分页下的所有信息
	public function getMenuByPage($data=array(),$page,$pagesize){
          $offset=($page -1)*$pagesize;
          
          $list=M('menu')->where($data)->order('listorder desc ,menu_id')->limit($offset,$pagesize)->select();
          
          return $list;
	}
	public function getMenuCount($data=array()){
		return M('menu')->where($data)->count();
	}

  //获得左侧导航栏的所有菜单项
    public function getMenus($data)
{
	return M('menu')->where($data)->select();
}
//通过menu_id获得菜单信息
public function getMenuById($data){
	return M('menu')->where($data)->find();
}
//更新菜单信息
public function updataMenu($id ,$data){
	return M('menu')->where("menu_id={$id}")->save($data);
}
//获取分类信息
public function getBarName(){
	$data=array(
		'status'=>array('eq',-1),
		'type'=>0,);
	return M('menu')->where($data)->order('listorder desc,menu_id')->select();
}

}








 ?>