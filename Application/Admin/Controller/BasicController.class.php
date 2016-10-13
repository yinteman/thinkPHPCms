<?php 
namespace Admin\Controller;
use Think\Controller;


/**
* 基本管理信息，将缓存数据到静态首页
*/
class BasicController extends Controller
{
	
	public function index(){
		
		$this->display();
	}
	public function add(){
       if (!$_POST) {
       	return show(0,'没有输入值');
       }
       if (!$_POST['title']) {
       	   return show(0,'没有输入站点标题');
       }
        if (!$_POST['keywords']) {
       	   return show(0,'没有输入站点关键词');
       }
       $data=$_POST;
         $id=D('Basic')->addBasic($data);
        
         if (!$id) {
         	return show(1,'添加成功');
         }else{
         	return show(0,'添加失败');
         }
	}
}
























 ?>