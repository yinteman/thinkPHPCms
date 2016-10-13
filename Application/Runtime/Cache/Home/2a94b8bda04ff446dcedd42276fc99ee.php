<?php if (!defined('THINK_PATH')) exit(); $cates=D("Menu")->getBarName(); ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>sing资讯</title>
  <link rel="stylesheet" href="/project/Public/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="/project/Public/css/home/main.css" type="text/css" />
   <link rel="stylesheet" href="/project/Public/css/party/bootstrap-switch.css" />
   
    <script src="/project/Public/js/jquery.js"></script>
    <script src="/project/Public/js/bootstrap.min.js"></script>
    <script src="/project/Public/js/dialog/layer.js"></script>
    <script src="/project/Public/js/dialog.js"></script>
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
        <div class="banner">
        <div class="banner-left">
          <div id="myCarousel" class="carousel slide">

  <ol class="carousel-indicators">
   <?php $__FOR_START_31585__=0;$__FOR_END_31585__=$result['total'];for($i=$__FOR_START_31585__;$i < $__FOR_END_31585__;$i+=1){ ?><li data-target="#myCarousel" data-slide-to="<?php echo ($i); ?>" 
    <?php if($i == 0): ?>class="active"<?php endif; ?>></li><?php } ?>
  </ol>
  <!-- Carousel items -->
  <div class="carousel-inner">
  <?php if(is_array($result['topPic'])): foreach($result['topPic'] as $k=>$val): ?><div <?php if($k == 0): ?>class="active item"<?php else: ?>class=" item"<?php endif; ?> > 
    <div class="banner-info"><span>阅读数</span><i class="news_count node-<?php echo ($val['news_id']); ?>" id="<?php echo ($val['news_id']); ?>"></i></div>
    <a href="Index.php/Home/c=Detail&id=<?php echo ($val['id']); ?>"><img src="<?php echo ($val['thumb']); ?>" alt=""  width="670" height="360"></a></div><?php endforeach; endif; ?>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
       </div>
          <div class="banner-right">
            <ul>
            <?php if(is_array($result['topSmail'])): foreach($result['topSmail'] as $key=>$pic): ?><li >
               <a href="/project/index.php?m=Home&c=Detail&id=<?php echo ($pic['id']); ?>"> <img src="<?php echo ($pic["thumb"]); ?>" alt="" width="150" height="113"><a>
              </li><?php endforeach; endif; ?>
              
            </ul>
          </div>
        </div>
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
              <?php echo ($new["username"]); ?><span><?php echo (date("y-m-h",$new["create_time"])); ?></span> 阅读
              <i 
              class="news_count node-<?php echo ($new['news_id']); ?>" id="<?php echo ($new['news_id']); ?>"></i>
            </dd>
          </dl><?php endforeach; endif; ?>
            
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
<script type="text/javascript" src="/project/Public/js/count.js"></script>
</html>