<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sing后台管理平台</title>
    <!-- Bootstrap Core CSS -->
    <link href="/project/Public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/project/Public/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/project/Public/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/project/Public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/project/Public/css/sing/common.css" />
    <link rel="stylesheet" href="/project/Public/css/party/bootstrap-switch.css" />
    <link rel="stylesheet" type="text/css" href="/project/Public/css/party/uploadify.css">

    <!-- jQuery -->
    <script src="/project/Public/js/jquery.js"></script>
    <script src="/project/Public/js/bootstrap.min.js"></script>
    <script src="/project/Public/js/dialog/layer.js"></script>
    <script src="/project/Public/js/dialog.js"></script>
    <script type="text/javascript" src="/project/Public/js/party/jquery.uploadify.js"></script>

</head>

    



<body>
<div id="wrapper">

    <?php
$data['status']=array('neq',-1); $navs=D('Menu')->getMenus($data); ?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    
    <a class="navbar-brand" >singcms内容管理平台</a>
  </div>
  <!-- Top Menu Items -->
  <ul class="nav navbar-right top-nav">
    
    
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li>
          <a href="/admin.php?c=admin&a=personal"><i class="fa fa-fw fa-user"></i> 个人中心</a>
        </li>
       
        <li class="divider"></li>
        <li>
          <a href="<?php echo U('Admin/Login/loginout');?>"><i class="fa fa-fw fa-power-off"></i> 退出</a>
        </li>
      </ul>
    </li>
  </ul>
  <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav nav_list">
      <li >
        <a href="<?php echo U('Admin/Index');?>"><i class="fa fa-fw fa-dashboard"></i> 首页</a>
      </li>
      <?php if(is_array($navs)): foreach($navs as $key=>$nav): ?><li>
        <a href="/project/index.php?m=Admin&c=<?php echo (ucfirst($nav["c"])); ?>" <?php echo (getActive($nav["c"])); ?> ><i class="fa fa-fw fa-bar-chart-o"></i><?php echo ($nav["name"]); ?></a>
      </li><?php endforeach; endif; ?>
    </ul>
  </div>
  <!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">

	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">

				<ol class="breadcrumb">
					<li>
						<i class="fa fa-dashboard"></i>  <a href="<?php echo U('index');?>">推荐位内容管理</a>
					</li>
					<li class="active">
						<i class="fa fa-edit"></i> 添加推荐位内容
					</li>
				</ol>
			</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-6">

				<form class="form-horizontal" id="singcms-form">
					<div class="form-group">
						<label for="inputname" class="col-sm-2 control-label">标题:</label>
						<div class="col-sm-5">
							<input type="text" name="title" class="form-control" id="inputname" placeholder="请填写标题">
						</div>
					</div>
					<div class="form-group">
						<label for="inputname" class="col-sm-2 control-label">选择推荐位:</label>
						<div class="col-sm-5">
							<select class="form-control" name="position_id">

									<option value="">请选择</option>
									<?php if(is_array($positions)): foreach($positions as $key=>$pos): ?><option value="<?php echo ($pos["id"]); ?>"><?php echo ($pos["name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="inputname" class="col-sm-2 control-label">缩图:</label>
						<div class="col-sm-5">
							<input id="file_upload"  type="file" multiple="true" >
							<img style="display: none" id="upload_org_code_img" src="" width="150" height="150">
							<input id="file_upload_image" name="thumb" type="hidden" multiple="true" value="">
						</div>
					</div>

					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">url:</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="url" id="inputPassword3" placeholder="请url地址">
						</div>
					</div>
					<div class="form-group">
						<label for="inputname" class="col-sm-2 control-label">文章id:</label>
						<div class="col-sm-5">
							<input type="text" name="news_id" class="form-control" id="inputname" placeholder="如果和文章无关联的可以不添加文章id">
						</div>
					</div>
					<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">状态:</label>
					<div class="col-sm-5">
						<input type="radio" name="status" id="optionsRadiosInline1" value="1" checked> 开启
						<input type="radio" name="status" id="optionsRadiosInline2" value="0"> 关闭
					</div>

				</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="button" class="btn btn-default" id="singcms-button-submit">提交</button>
						</div>
					</div>
				</form>


			</div>

		</div>
		<!-- /.row -->

	</div>
	<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
</div>
<script>
	var SCOPE = {
		'save_url' : '<?php echo U("addHandle");?>',
		'jump_url' : '<?php echo U("index");?>',
		'ajax_upload_image_url' : '/project/index.php?m=Admin&c=Image&a=ajaxUploadimage',
		'ajax_upload_swf' : '/project/Public/js/party/uploadify.swf'
	};

	/***编写js代码*/

</script>
<!-- /#wrapper -->
<script type="text/javascript" src="/project/Public/js/admin/form.js"></script>
<script src="/project/Public/js/admin/image.js"></script>
<script src="/project/Public/js/admin/common.js"></script>



</body>

</html>