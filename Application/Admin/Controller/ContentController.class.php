<?php 
namespace Admin\Controller;
use Think\Controller;

/**
* 博客管理
*/
class ContentController extends Controller
{
	
	  public function index(){
	  	$this->wibeName=D('Menu')->getBarName();
	  	$condition=array();
	  	if(isset($_GET['catid'])&&$_GET['catid']) {
	  		$condition['catid']=$_GET['catid'];
	  	}
	  	if (isset($_GET['title'])&&$_GET['title']) {
	  		$condition['title']=$_GET['title'];
	  	}

      $positions=D('Position')->select();
      $this->positions=$positions;

	    $page=isset($_REQUEST['p'])?$_REQUEST['p']:1;
		$listRows=isset($_REQUEST['listRows'])?$_REQUEST['listRows']:2;
	  	$rows=D('News')->select($condition,$page,$listRows);
	  	$count=D('News')->getCount($condition);
       
	  	
        $pages=new \Think\Page($count,$listRows);
        $p=$pages->show();
        
	  	$this->rows=$rows;
	  	$this->page=$p;
    	$this->display();
    }
    public function add(){
    	$wibeName=D('Menu')->getBarName();
    	$titlecolor=C('TITLE_FONT_COLOR');
    	$copyFrom=C('COPY_FROM');
    	$this->copyFrom=$copyFrom;
    	$this->titlecolor=$titlecolor;
    	$this->wibeName=$wibeName;
    	$this->display();
    }
    public function addHandle(){
    	if (! isset($_POST['title'])||! $_POST['title']) {
    		return show(0,"标题不能为空");
    	}
    	if (! isset($_POST['catid'])||! $_POST['catid']) {
    		return show(0,"栏目不能为空");
    	}
    	if (! isset($_POST['content'])||! $_POST['content']) {
    		return show(0,"内容不能为空");
    	}
        $data=$_POST;
        $id=D('News')->addNews($data);
        if (!$id) {
        	return show(0,'添加失败');
        }
        $NewsContent['content']=$data['content'];
        $NewsContent['news_id']=$id;
        $NewsContent['create_time']=time();
        $res=D('NewsContent')->addNewsContent($NewsContent);
        if ($res) {
        	return show(1,"添加成功");
        }else{
        	return show(0,"添加失败");
        }
    }

  public function edit(){
  	$wibeName=D('Menu')->getBarName();
    	$titlecolor=C('TITLE_FONT_COLOR');
    	$copyFrom=C('COPY_FROM');
    	$this->copyFrom=$copyFrom;
    	$this->titlecolor=$titlecolor;
    	$this->wibeName=$wibeName;
  	$data['news_id']=$_GET['id'];
  	$rows=D('News')->getNewsById($data);
  	$content=D('NewsContent')->selectNewsContentByid($data);
  	$this->rows=$rows;
  	$this->content=$content;
  	$this->display();
  }

  public function editHandle(){

  	if (! isset($_POST['title'])||! $_POST['title']) {
    		return show(0,"标题不能为空");
    	}
    	if (! isset($_POST['catid'])||! $_POST['catid']) {
    		return show(0,"栏目不能为空");
    	}
    	if (! isset($_POST['content'])||! $_POST['content']) {
    		return show(0,"内容不能为空");
    	}
        $data=$_POST;
        $newsId=intval($data['news_id']);

       $newId=D('News')->updataNews($newsId,$data);
       
        if ($newId){
        	
        	$NewsContent['content']=$data['content'];
        	$NewsContent['updata_time']=time();
        	$NewsContent['news_id']=$newsId;
        	$res=D('NewsContent')->updataNewsContent($newsId,$NewsContent);
          
        	if ($res) {
        		return show(1,"修改成功");
        	}
        }else{
        	return show(0,'修改失败');
        }
       
  }
  public function setStatus(){
  
    $newsId=$_POST['id'];
    $data['status']=$_POST['status'];
    $newId=D('News')->updataNews($newsId,$data);
    if ($newId) {
    	return show(1,'更改成功');
    }else{
    	return show(0,'更改失败');
    }
  }
  public function listorder(){
  	$data=$_POST;
  	$order=array();
  	$error=array();
  	foreach ($data as $key => $val ){
  		$newsId=$key;
  		$order['listorder']=$val;
  		$order['news_id']=$key;
  	  
  		$res=D('News')->updataNews($newsId,$order);
  		
  	}
  	if (!$res) {
  		return show(0,"排序失败",array("jump_url"=>U('index')));
  	}
  	else{
  		return show(1,"排序成功",array("jump_url"=>U('index')));
  	}
  	}

    /******推送**************/
    public function push(){
      if (!isset($_POST['position_id']) || !$_POST['position_id']) {
         return show(0,"请选择推荐位");
      }
      if (!isset($_POST['push']) || !is_array($_POST['push'])) {
         return show(0,"请选择要推荐的文章");
      }

     $position_id=$_POST['position_id'];
      $rows=D('News')->getNewsGroupById($_POST['push']);
      if (!$rows) {
        return show(0,'没有相关的内容');
      }
      foreach ($rows as $key => $row) {
        $data['position_id']=$position_id;
       $data['title']=$row['title'];
       $data['thumb']=$row['thumb'];
       $data['news_id']=$row['news_id'];
       $data['status']=1;
       $data['create_time']=$row['create_time'];
      }
      $res=D('PositionContent')->add($data);
      if ($res) {
        $jumpurl='/project/index.php?m=Admin&c=Positioncontent&a=index';
        return show(1,'推荐成功',array('jump_url'=>$jumpurl));
      }
      return show(0,'推荐失败');


    }
}

























 ?>