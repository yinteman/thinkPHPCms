<?php 
namespace Admin\Controller;
use Think\Controller;

/**
* 菜单管理控制器
*/
class MenuController extends Controller
{
	
	public function index(){
		$data['status']=array('neq',-1);
		if (isset($_REQUEST['type'])&& in_array($_REQUEST['type'], array(0,1))){
			$data['type']=intval($_REQUEST['type']);
			$this->type=intval($_REQUEST['type']);
		}
		if ($_REQUEST['type']==='') {
			unset($data['type']);
		    $this->type='';
		}
		$page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
		$listRows=isset($_REQUEST['listRows'])?$_REQUEST['listRows']:3;
        
        $rows=D('Menu')->getMenuByPage($data,$page,$listRows);
        $num=D('Menu')->getMenuCount($data);
        
        $page=new \Think\Page($num,$listRows);
        $p=$page->show();
        $this->rows=$rows;
       // $this->page=$p;
        $this->listRows=$listRows;
		$this->display();
	}
	/*****************
*添加功能
	****/

	public function addMenu(){
      $this->display('add');
	}
	public function addHandle(){
		if (!isset($_POST['name']) || !$_POST['name']) {
		    return show(0,'用户名不能为空');
		}
		if (!isset($_POST['m']) || !$_POST['m']) {
		    return show(0,'模块不能为空');
		}
		if (!isset($_POST['c']) || !$_POST['c']) {
		    return show(0,'控制器不能为空');
		}
		if (!isset($_POST['f']) || !$_POST['f']) {
		    return show(0,'方法不能为空');
		}
		$data=$_POST;
		$menuId=D('Menu')->addMenu($data);
		if ($menuId){
			return show(1,'添加成功');
		}else{
			return show(0,'添加失败');
		}
     
	}
/**************
*修改功能
***/

public function updataMenu(){
	
	$data['menu_id']=isset($_GET['id'])?intval($_GET['id']):'';
	$row=D('Menu')->getMenuById($data);
	$this->row=$row;
	$this->display('updata');
}
public function updataHandle(){
	$menuId=$_POST['menuId'];
	$data=$_POST;
	$res=D('Menu')->updataMenu($menuId,$data);
	if ($res) {
		return show(1,'添加成功');
	}else{
		return show(0,'添加失败');
	}
}
/***
*删除功能
*/
public function  setStatus(){
	$data=$_POST;
	$menuId=$data['id'];
	$res=D('Menu')->updataMenu($menuId,$data);
	if ($res) {
		return show(1,'删除成功');
	}else{
		return show(0,'删除失败');
	}
}
/**
*排序更新功能
*/

public function listorder(){
    $listorder=[];
    $res=[];
	$data=$_POST;
	foreach ($data as $key => $value) {
		$listorder['menu_id']=$key;
		$listorder['listorder']=$value;
		$res[]=D('Menu')->updataMenu($listorder['menu_id'],$listorder);
	}
	if ($res) {
		$jump_url=$_SERVER['HTTP_REFERER'];
		return show(1,'排序成功', array('jump_url' =>$jump_url ));
	}else{
		return show(0,'排序失败', array('jump_url' =>$jump_url ));
	}
	
	
}
}
























 ?>