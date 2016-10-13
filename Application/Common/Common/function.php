<?php 
/****
*公共函数
*/

function show($statue,$msg,$data){
	$result = array(
		'status' => $statue,
		'msg'=>$msg,
		'data'=>$data );
	exit(json_encode($result));
}


function getMd5Password($pwd){
	return md5($pwd,C('MD5_PRE'));
}

function getTypes($type){
	return $type==1?'后台管理':'前台管理';
}

function getStatus($status){
	switch ($status) {
		case 1:
			return "开启";
			break;
		case 0:
			return "休眠";
			break;
	}}
	/****
     *获得激活
	*/
	function getActive($navc){
        $c=strtolower(CONTROLLER_NAME);
        if($navc ==$c){
        	return "class='active'";
        }else{
        	return "";
        }
	}

/***
富文本上传其
*/
function showKindle($status,$data)
{
	if ($status){
	exit(json_encode(array('error'=>0,'url'=>$data)));
	}else{
		exit(json_encode(array('error'=>1,'message'=>$data)));
	}
}
	/**
*获取分类名称
	*/
function getCatName($id){
	$data['menu_id']=$id;
	$catName=D('Menu')->getMenuById($data);
	return $catName['name'];
}
function getCopyName($id){
	$data=C('COPY_FROM');
	foreach ($data as $key => $val) {
		if ($key ==$id) {
			return $val;
		}
	}
   

}
function isThumb($data){
	return $data==''?"无":"<span style='color:red'>有</span>";
}
















 ?>