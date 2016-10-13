<?php 
namespace Home\Controller;
use Think\Controller;


/**
* 分类
*/
class CatController extends Controller
{
	
	public function  index(){
        $id=$_GET['catid'];
        
		$page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
		$listRows=isset($_REQUEST['listRows'])?$_REQUEST['listRows']:3;
        $cond = array('catid' =>$id);
		$listNes=D('News')->select($cond,$page,$listRows);
		$cout=D('News')->getCount($cond);
        $total=ceil($cout /$listRows);
		
    	$adList=D('PositionContent')->select(array('status'=>1,'position_id'=>5,'limit'=>2));
    	$getRank=D('News')->getRank();
         


        $result=array(
         
         'listNes'=>$listNes,
         'ranknews'=>$getRank,
         'adList'=>$adList,
         'page'=>$p,
         );
         $this->listRows=$total;
         $this->cid=intval($id);
        $this->result=$result;
		$this->display();
	}
}















 ?>