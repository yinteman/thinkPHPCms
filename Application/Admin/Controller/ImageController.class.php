<?php 
namespace Admin\Controller;
use Think\Controller;

/**
* 图片上传以及缩略图
*/
class ImageController extends Controller
{
	
	public function ajaxUploadimage(){
		$res=D('UploadImage')->imageUpload();//$res是上传图形之后的路径;
		
		if ($res===false) {
			return show(0,'上传失败');
		}else{
			return show(1,'上传成功',$res);
		}
	}

	public function kindupload()//富文本编辑器上传的图片
	{
       $res=D('UploadImage')->upload();
       if ($res===false) {
          return showKindle(0,'上传失败');
       }
        $res="/project".$res;
      
       return showKindle(1,$res);

	}
}















 ?>