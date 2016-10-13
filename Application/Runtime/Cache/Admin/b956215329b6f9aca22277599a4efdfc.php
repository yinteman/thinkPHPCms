<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="#">菜单管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i><?php echo ($nav); ?>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <form action="<?php echo U('index');?>" method="get">

                <div class="input-group">
                    <span class="input-group-addon">类型</span>
                    <select class="form-control" name="type">
                        <option value='' >请选择类型</option>

                        <option value="1" <?php if($type == 1): ?>selected="selected"<?php endif; ?>>后台菜单</option>
                        <option value="0" <?php if($type == 0): ?>selected="selected"<?php endif; ?> >前端导航</option>
             
                </div>

                <input type="hidden" name="c" value="menu"/>
                <input type="hidden" name="a" value="index"/>
                <span class="input-group-btn">
                  <button id="sub_data" type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-search"></i><button>
                </span>

            </form>
        </div>
        <div>
          <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3></h3>
                <div class="table-responsive">
                    <form id="singcms-listorder" type="">
                    <table class="table table-bordered table-hover singcms-table">
                        <thead>
                        <tr>
                            
                            <th width="14">排序</th>
                            <th>id</th>
                            <th>菜单名</th>
                            <th>模块名</th>
                            <th>类型</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                            
                            <td ><input name="<?php echo ($row["menu_id"]); ?>" value="<?php echo ($row["listorder"]); ?>"  width="14"/></td>
                            <td><?php echo ($row["menu_id"]); ?></td>
                            <td><?php echo ($row["name"]); ?></td>
                            <td><?php echo ($row["m"]); ?></td>
                            <td><?php echo (getTypes($row["type"])); ?></td>
                            <td><?php echo (getStatus($row["status"])); ?></td>
                            
                       
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true" id="singcms-edit" attr-id="" onclick="edit(<?php echo ($row['menu_id']); ?>)"></span>    <a href="javascript:void(0)" attr-id="" id="singcms-delete"  attr-a="menu" attr-message="删除" onclick="deleteMenu(<?php echo ($row['menu_id']); ?>)"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
                                
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                    </table>
                    <button  class="btn btn-defalut" id="order"  type="button">排序</button>
                    </form>

                  

                    
                </div>
               <ul id="biuuu_city_list"></ul>

                   <div id="biuuu_city"></div>

            </div>

        </div>
        <!-- /.row -->



    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Morris Charts JavaScript -->
<script>

    var SCOPE = {
        'jump_url' :"<?php echo U('Index');?>",
        'add_url' : "<?php echo U('addMenu');?>",
        'edit_url' : '<?php echo U("updataMenu");?>',
        'set_status_url' : '<?php echo U("setStatus");?>',
        'listorder_url' : '<?php echo U("listorder");?>',

    }


laypage({
    cont: 'biuuu_city',
    pages: <?php echo ($listRows); ?>,
    curr:  function(){ //通过url获取当前页，也可以同上（pages）方式获取
        var page = location.search.match(/page=(\d+)/);
        return page ? page[1] : 1;
    }(), 
    jump: function(e, first){ //触发分页后的回调

        if(!first){ //一定要加此判断，否则初始时会无限刷新
            var currs=e.curr;

            location.href ="/project/index.php?m=Admin&c=Menu&a=index&page="+currs;}}
            
})
</script>
<script src="/project/Public/js/admin/common.js"></script>



</body>

</html>