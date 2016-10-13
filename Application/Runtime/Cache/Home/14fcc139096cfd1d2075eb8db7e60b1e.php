<?php if (!defined('THINK_PATH')) exit(); $cates=D("Menu")->getBarName(); ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>sing资讯</title>
  <link rel="stylesheet" href="/project/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/project/Public/css/home/main.css" type="text/css" />

   <script type="text/javascript" src="/project/Public/laypage-v1.3/laypage/laypage.js"></script>
</head>
<body>
<header id="header">
  <div class="navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <a href="">
          <img src="/project/Public/images/logo.png" alt="">
        </a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><a href="Index.php?m=Home&c=Cat" <?php if($cid == ''): ?>class="curr"<?php endif; ?>>首页</a></li>
        <?php if(is_array($cates)): foreach($cates as $key=>$cate): ?><li><a href="Index.php?m=Home&c=Cat&catid=<?php echo ($cate['menu_id']); ?>" <?php if($cate['menu_id'] == $cid): ?>class="curr"<?php endif; ?>><?php echo ($cate["name"]); ?></a></li><?php endforeach; endif; ?>
      </ul>
    </div>
  </div>
</header>
<section>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-9">
        
        <div class="news-list">
        <?php if(is_array($result['listNes'])): foreach($result['listNes'] as $key=>$new): ?><dl>
            <dt><?php echo ($new["title"]); ?></dt>
            <dd class="news-img" >
              <a href="/project/index.php?m=Home&c=Detail&id=<?php echo ($new['news_id']); ?>" target="_blank"><img src="<?php echo ($new["thumb"]); ?>" alt="" width="170"></a>
            </dd>
            <dd class="news-intro">
              <?php echo ($new["small_title"]); ?>
            </dd>
            <dd class="news-info">
              <?php echo ($new["username"]); ?><span><?php echo (date("y-m-h",$new["create_time"])); ?></span> 阅读(<?php echo ($new["count"]); ?>)
            </dd>
          </dl><?php endforeach; endif; ?>
           <ul id="biuuu_city_list"></ul>

            <div id="biuuu_city"></div>
        </div>
      </div>
      <div class="col-sm-3 col-md-3">
        <div class="right-title">
          <h3>文章排行</h3>
          <span>TOP ARTICLES</span>
        </div>
        <div class="right-content">
          <ul>
          <?php if(is_array($result['ranknews'])): $k = 0; $__LIST__ = $result['ranknews'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?>  curr">
              <a href="/project/index.php?m=Home&c=Detail&id=<?php echo ($new['news_id']); ?>" target="_blank"><?php echo ($new["title"]); ?></a>
              <?php if($k == 0): ?><div class="intro">
                <?php echo ($news["small_title"]); ?>
              </div><?php endif; ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
        </div>
        <?php if(is_array($result['adList'])): $k = 0; $__LIST__ = $result['adList'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ads): $mod = ($k % 2 );++$k;?><div class="right-hot">
          <a href="/project/index.php?m=Home&c=Detail&id=<?php echo ($ads['news_id']); ?>"><img src="<?php echo ($ad["thumb"]); ?>" alt=""></a>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
        
      </div>
    </div>
  </div>
  
</section>
</body>
<script type="text/javascript">

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

            location.href ="/project/index.php?m=Home&c=Cat&a=index&page="+currs;}}
            
})



</script>


</html>