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

    <div class="container-fluid" >

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">

                    <li class="active">
                        <i class="fa fa-table"></i>推荐位内容管理
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div >
            <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
        </div>

        <div class="row">
            <form action="<?php echo U('index');?>" method="get">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-addon">推荐位</span>
                        <select class="form-control" name="position_id">
                                <option value="">请选择</option>
                                <?php if(is_array($positions)): foreach($positions as $key=>$position): ?><option value="<?php echo ($position["id"]); ?>"
                                 <?php if($position['id'] == $positionid): ?>selected="selected"<?php endif; ?>
                                ><?php echo ($position["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="c" value="positioncontent"/>
                <input type="hidden" name="a" value="index"/>
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control" name="title" type="text" value="" placeholder="文章标题" />
                <span class="input-group-btn">
                  <button id="sub_data" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                </span>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h3></h3>
                <div class="table-responsive">
                    <form id="singcms-listorder">
                    <table class="table table-bordered table-hover singcms-table">
                        <thead>
                        <tr>
                            <th width="14">排序</th><!--7-->
                            <th>id</th>
                            <th>标题</th>
                            <th>时间</th>
                            <th>封面图</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($rows)): foreach($rows as $key=>$row): ?><tr>
                                <td><input size=4 type='text'  name='<?php echo ($row["id"]); ?>' value="<?php echo ($row["listorder"]); ?>"/></td>
                                <td><?php echo ($row["id"]); ?></td>
                                <td><?php echo ($row["title"]); ?></td>
                                <td><?php echo (date("y-m-h",$row["create_time"])); ?></td>
                                <td><?php echo (isThumb($row["thumb"])); ?></td>
                                <td>
                                    <span  attr-status="<?php echo ($row["status"]); ?>"  attr-id="<?php echo ($row["id"]); ?>" class="sing_cursor singcms-on-off" id="singcms-on-off" >
                                    <?php echo (getStatus($row["status"])); ?></span>
                                </td>
                                <td>
                                    <span class="sing_cursor glyphicon glyphicon-edit" aria-hidden="true" id="singcms-edit" attr-id="" 
                                    onclick="edit(<?php echo ($row['id']); ?>)"></span>
                                    <a href="javascript:void(0)" id="singcms-delete"  attr-id=""  attr-message="删除" onclick="deleteMenu(<?php echo ($row['id']); ?>)">
                                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    </from>
                    <div>
                        <button  id="order" type="button" class="btn btn-primary dropdown-toggle" ><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>更新排序</button>
                    </div>
                </div>
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
        'edit_url' : '<?php echo U("edit");?>',
        'jump_url' :'<?php echo U("index");?>',
        'set_status_url' : '<?php echo U("setState");?>',
        'add_url' : '<?php echo U("add");?>',
        'listorder_url' : '<?php echo U("listorder");?>',
    }

</script>
<script src="/project/Public/js/admin/common.js"></script>



</body>

</html>