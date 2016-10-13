<?php 
namespace Admin\Controller;
use Think\Controller;

/**
* 推荐位内容管理
*/
class PositioncontentController extends Controller
{
	
	function index(){
		$positions=D('Position')->select();
		$this->positions=$positions;

		if (isset($_GET['position_id'])&& $_GET['position_id']) {
			$position_id=intval($_GET['position_id']);
			$condition['position_id']=intval($_GET['position_id']);
		}
		if (isset($_GET['title'])&& $_GET['title']) {
			$title=$_GET['title'];
			$condition['title']=array('like','%'.$title.'%');
		}
		
		
		$rows=D('PositionContent')->select($condition);
		$this->positionid=$position_id;
		$this->rows=$rows;
		$this->display();
	}

	public function add(){
		$positions=D('Position')->select();
		$this->positions=$positions;

		$this->display();
	}

	public function addHandle(){

		if (!isset($_POST['title'])|| !$_POST['title']) {
			return show(0,'标题不能为空');
		}
		if (!isset($_POST['position_id']) || !$_POST['position_id']) {
			return show(0,'推荐位不能为空');
		}
		if ( !$_POST['url'] && !$_POST['news_id']) {
			return show(0,'请至少添加一项');
		}

		if ($_POST['news_id'] && is_numeric($_POST['news_id'])) {
			$news_id=$_POST['news_id'];
			$data['news_id']=intval($news_id);
			$news=D('News')->getNewsById($data);

			if ($news) {
				if ($news['thumb']) {
					$_POST['thumb']=$news['thumb']; //将图片值传递给前台页面
				   
				}
			   }else{
                  return show(0,'文章不存在');
			}}
        $data=$_POST;

        $res=D('PositionContent')->add($data);
        if ($res) {
        	return show(1,'添加成功');
        }else{
        	return show(0,'添加失败');
        }
	}

	public function edit(){
		$id=$_GET['id'];
		$data['id']=$id;
		$rows=D('PositionContent')->selectById($data);
		$posID=$rows['position_id'];
		$this->rows=$rows;
		$positions=D('Position')->select();
		$this->positions=$positions;
		$this->posID=intval($posID);
		$this->display();
	}
	function editHandle(){
		$id=$_POST['id'];
		$data['id']=$id;

		$res=D('PositionContent')->updata($data,$_POST);
		if ($res===false) {
			return show(0,'修改失败');
		}
		return show(1,'修改成功');
	}
	public function setState(){
		
		$data['id']=$_POST['id'];

		$res=D('PositionContent')->updata($data,$_POST);
		if ($res===false) {
			return show(0,'修改失败');
		}
		return show(1,'修改成功');
	}
    public function listorder(){
    	$rows=$_POST;
    	$data;
    	$jum=U('index');
    	$error=array();
    	foreach ($rows as $key => $row) {
    		$data['id']=$key;
    		$data['listorder']=$row;
    		$condition['id']=$key;
    		$res=D('PositionContent')->updata($condition,$data);
    		if ($res===false) {
    			$error[]=$key;
    		}
    	}

    	if ($error){
    		return show(0,'排序错误');
    	}
    	return show(1,'排序正确',array('jump_url'=>$jum));
    }


}




















 ?>