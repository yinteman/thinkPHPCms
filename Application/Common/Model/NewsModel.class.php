<?php 
namespace Common\Model;
use Think\Model;

/**
* 文章内容主表
*/
class NewsModel extends Model
{
	
	public function addNews($data){
		if (!$data|| !is_array($data)) {
			return 0;
		}
		$data['username']=isset($_SESSION['admin']['name'])?$_SESSION['admin']['name']:'admin';
		$data['create_time']=time();

		return M('news')->data($data)->add();
	}
	public function select($data=array(),$page,$pagesize){
		$page==''?$page:1;
		$condition=array();
		$condition['status']=array('neq',-1);
		if ($data['catid'] || is_numeric($data['catid'])) {
		
		$condition['catid']=intval($data['catid']);
		}
		
		
		$offset=($page-1)*$pagesize;
		return M('news')->where($condition)->order('listorder desc,news_id')
		->limit($offset,$pagesize)->select();
	}
	public function getCount($data=array()){
		$condition=array();
		$condition['status']=array('neq',-1);
		if ($data['catid'] || is_numeric($data['catid'])) {
		
		$condition['catid']=intval($data['catid']);
		}
		return M('news')->where($condition)->count();
	
	}
	public function getNewsById($data){
		if (!$data ||!is_array($data)) {
			return 0;
		}
		return M('news')->where($data)->find();
	}

	public function updataNews($newsId,$data){
   
		if ($newsId==''||!is_numeric($newsId)) {
			return 0;
			}
			
		if ($data==''|| !is_array($data)) {
			return 0;
		}
      $data['news_id']=$newsId;
			$condition['news_id']=$newsId;
		return  M('news')->where($condition)->save($data);

	}
	public function getNewsGroupById($data){
		if (!isset($data) || !is_array($data)){
			return 0;
		}
		$condition['news_id']=array('in',implode(',', $data));
		return M('news')->where($condition)->select();
	}
	public function getRank(){
		$condition = array('status' => 1);
		return M('news')->where($where)->order('count desc,news_id')->select();
	}

}
















 ?>