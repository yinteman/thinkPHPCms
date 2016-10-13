<?php 
namespace Common\Model;
use Think\Model;


/**
* 基本设置层，利用F设置缓存
*/
class BasicModel extends Model
{
	public function __construct(){}
	
	public function addBasic($data=array()){
		if (!$data) {
			return 0;
		}

		$id=F('basic_web_config',$data);


		return $id; //生成静态缓存数据
	}

	public function  showup(){
		return F('basic_web_config');
	}
}



































 ?>