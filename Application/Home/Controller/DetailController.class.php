<?php 
namespace Home\Controller;
use Think\Controller;


/**
* 
*/
class DetailController extends Controller
{
	
	public function index(){
		$id=intval($_GET['id']);

		if (!$id || !is_numeric($id)) {
			return 0;
		}
        $data['news_id']=$id;
		$news=D('News')->getNewsById($data);
		if (!news || !is_array($news)) {
			return 0;
		}

		$count=intval($news['count'])+1;
		$data['count']=$count;
		$res=D('news')->updataNews($id,$data);
		if (!$res) {
			return 0;
		}
        
        $cond['news_id']=$id;
		$content=D('NewsContent')->selectNewsContentByid($cond);
		$news['content']=htmlspecialchars_decode($content['content']);

		$adList=D('PositionContent')->select(array('status'=>1,'position_id'=>5,'limit'=>2));
    	$getRank=D('News')->getRank();
    	$catid=$_GET['catid'];

    	$result=array(
         
         
         'ranknews'=>$getRank,
         'adList'=>$adList,
         
         );
         $this->result=$result;
         $this->news=$news;
         $this->cid=intval($catid);
         $this->display("Detail/index");
	}
	public function view(){//后台的预览效果
		$this->index();
	}
}
















 ?>