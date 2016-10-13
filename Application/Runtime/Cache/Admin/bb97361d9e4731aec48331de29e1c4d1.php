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

    <!-- 分页 -->
    <script type="text/javascript" src="/project/Public/laypage-v1.3/laypage/laypage.js"></script>

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
			<a href="<?php echo U('index');?>"><button type="button" class="btn btn-primary"> 基本配置</button></a>
		</div>
		</div>
		<!-- /.row -->

		<div class="row">
			<div class="col-lg-6">

				<form class="form-horizontal" id="singcms-form">
					<div class="form-group">
						<label for="inputname" class="col-sm-2 control-label">站点标题:</label>
						<div class="col-sm-5">
							<input type="text" name="title" value="" class="form-control" id="inputname" placeholder="请填写站点标题">
						</div>
					</div>

					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">站点关键词:</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" value="" name="keywords" id="inputPassword3" placeholder="请填写站点关键词">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">站点描述:</label>
						<div class="col-sm-5">
							<textarea class="form-control" rows="3" name="description"></textarea>
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
<!-- /#wrapper -->
<script>
	var SCOPE = {
		'save_url' : "<?php echo U('add');?>",
		'jump_url' : '<?php echo U("index");?>',
	};

</script>
<script src="/project/Public/js/admin/common.js"></script>



</body>

</html>