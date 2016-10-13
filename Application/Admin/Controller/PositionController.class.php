<?php 
namespace Admin\Controller;
use Think\Controller;

/**
* 推荐位管理
*/
class PositionController extends Controller
{
	
	public function index(){
		$rows=D('Position')->select();
		$this->rows=$rows;
		$this->display();
	}
	public function add(){

		$this->display();
	}

	public function addHandle(){
		if(!isset($_POST['name']) || !$_POST['name']){
			return show(0,'请输入推荐名');
		}
		if (!isset($_POST['status']) || !$_POST['status']) {
			return show(0,'请选择状态');
		}

		$res=D('Position')->add($_POST);
		if ($res === false) {
			return show(0,'添加失败');
		}
		return show(1,"添加成功");
	}
	public function edit(){
	if(!isset($_GET['id'])|| !$_GET['id']){
		return show(0,'没有获取到ID值');
	}
	$id=$_GET['id'];
	$rows=D('Position')->getRowsById($id);
	if ($rows && is_array($rows)) {
		$this->row=$rows;
		$this->display();
	}
	return show(0,'编辑失败');
	}

	public function editHandle(){
		$id=$_POST['id'];

		if(!isset($_POST['name']) || !$_POST['name']){
			return show(0,'请输入推荐名');
		}
		if (!isset($_POST['status']) || !$_POST['status']) {
			return show(0,'请选择状态');
		}
        $data=$_POST;
        $data['updata_time']=time();
        $res=D('Position')->updata($id,$data);
        if ($res===false) {
        	return show(0,'修改失败');
        }
        return show(1,'更新成功');
	}
	public function setStatus(){
		
		if (!isset($_POST)||!$_POST) {
			return show(0,'删除失败');
		}
		$id=$_POST['id'];
		$data=$_POST;
		$data['updata_time']=time();
        $res=D('Position')->updata($id,$data);
        if ($res===false) {
        	return show(0,'修改失败');
        }
        return show(1,'更新成功');
         

	}
}
















 ?>