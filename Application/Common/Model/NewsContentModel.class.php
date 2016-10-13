<?php 
namespace Common\Model;
use Think\Model;


/**
* 文章内容管理
*/
class NewsContentModel extends Model
{
	
	public function addNewsContent($data){
		if (!$data|| !is_array($data)) {
			return 0;
		}
         
		return M('news_content')->data($data)->add();
	}
	public function selectNewsContentByid($data){
		if (!$data|| !is_array($data)) {
			return 0;
		}
		return M('news_content')->where($data)->find();
	}
	public function updataNewsContent($news_id,$data){
       
		if (!$data|| !is_array($data)) {
			return 0;
		}
		if ($news_id=='' ||!is_numeric($news_id)) {
			return 0;
			}

		$condition['news_id']=intval($news_id);	
        

		return M('news_content')->where($condition)->save($data);
	}
}



















 ?>