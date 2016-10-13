<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$topPic=D('PositionContent')->select(array('status'=>1,'position_id'=>2,'limit'=>1));
    	$topSmail=D('PositionContent')->select(array('status'=>1,'position_id'=>3));
    	$listNes=D('News')->select(array('','',30));
    	$adList=D('PositionContent')->select(array('status'=>1,'position_id'=>5,'limit'=>2));
    	$getRank=D('News')->getRank();
    	
        $total=count($topPic);
        $result=array(
         'topPic'=>$topPic,
         'topSmail'=>$topSmail,
         'listNes'=>$listNes,
         'ranknews'=>$getRank,
         'adList'=>$adList,
         'total'=>$total,);
        $this->result=$result;

        $this->display();
    }


    public function getCount(){
    $data=$_POST;
    $data=array_unique($_POST);
    $res=D('News')->getNewsGroupById($data);
  
    if (!$res) {
      return show(0,'notdata');
    }else{
        $arr=array();
        foreach ($res as $key => $v) {
           $arr[$v['news_id']]=intval($v['count']);
        }
        return show(1,'success',$arr);
    }

    }
}