<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta property="qc:admins" content="33365502476305135636" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="<?php echo C('CSS_URL');?>bootstrap.min.css" type="text/css" rel="stylesheet">
  <link href="<?php echo C('CSS_URL');?>style.css" type="text/css" rel="stylesheet">
  <link type="text/css" href="<?php echo C('CSS_URL');?>bootstrapValidator.min.css" rel="stylesheet">
  <script src="<?php echo C('JS_URL');?>jquery-2.1.4.min.js" type="text/javascript"></script>
  <link rel="apple-touch-icon-precomposed" href="<?php echo C('IMG_URL');?>icon/icon.png">
  <link rel="shortcut icon" href="<?php echo C('IMG_URL');?>icon/favicon.ico">
  <meta name="Keywords" content=""/>
  <meta name="description" content=""/>
</head>
<!--导航条开始-->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation"
     style="background-color:#dddddd;border-bottom: none;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#demo-navbar">
        <span class="sr-only"><a href="<?php echo U('Index/index');?>">Toggle navigation</a></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button>
      <a class="navbar-brand" href="<?php echo U('Index/index');?>">Age of Technology</a>
    </div>
    <div class="collapse  navbar-collapse" id="demo-navbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li><a href="javascript:;">简述</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">开发必备<span
            class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="http://www.chromeliulanqi.com/" target="_blank">Chrome</a></li>
            <li><a href="http://www.firefox.com.cn/download/" target="_blank">Firefox</a></li>
            <li><a href="http://www.opera.com/zh-cn" target="_blank">Opera</a></li>
            <li class="divider"></li>
            <li><a href="https://support.microsoft.com/zh-cn/help/17621/internet-explorer-downloads" target="_blank">IE</a></li>
            <li><a href="http://www.apple.com/cn/osx/apps/?cid=wwa-cn-kwb-mac" target="_blank">Safari</a></li>
          </ul>
        </li>
        <li><a href="<?php echo U('Author/index');?>">开发者</a></li>
      </ul>
      <?php if(!empty($_SESSION['user_name'])): ?><form class="navbar-form navbar-right" role="form" style="line-height: 30px;">
          <div class="form-group">
            <a class="nav-a" href="<?php echo U('User/userinfo');?>">
              <img  class="img-circle" title="个人信息" style="width: 35px;height: 35px;"
              <?php if(!empty($_SESSION['user_small_logo'])): ?>src="<?php echo C('SITE_URL'); echo (substr(session('user_small_logo'),2)); ?>"<?php endif; ?> >
            </a>
            <a id="logout" class="nav-a" href="<?php echo U('User/logout');?>">退出</a>
            <a class="nav-a" href="<?php echo U('Article/write');?>">发布文章</a>
          </div>
      </form>

        <?php else: ?>
        <form class="navbar-form navbar-right" role="form" style="line-height: 30px;">
          <div class="form-group">
            <a id="register" class="nav-a" data-toggle="modal" data-target="#register_header">注册</a>
            <a id="login_button" class="nav-a" data-toggle="modal" data-target="#login_header">登录</a>
          </div>
        </form><?php endif; ?>

    </div>
  </div>
</nav>
<!--导航条结束-->
<script type="text/javascript">
  $(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $('#myTooltip').tooltip({
  title:"我是一个提示框，我在顶部出现",
  placement:'bottom'
  });
  });
</script>

<!--注册表单开始-->
<div class="modal fade" id="register_header">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="text-success text-center">请填写以下内容</h4>
      </div>
      <form role="form" id="register_form" class="form-horizontal" action="<?php echo U('User/register');?>" method="post">
        <div class="modal-body">

          <div class="form-group">
            <label for="register_user" class="col-md-2 control-label">用户名:</label>
            <div class="col-md-10">
              <input class="form-control" id="register_user" type="text" name="user_name" placeholder="请输入用户名.">
              <span></span>
            </div>
          </div>
          <div class="form-group">
            <label for="register_pass" class="col-md-2 control-label">密码:</label>
            <div class="col-md-10">
              <input class="form-control" id="register_pass" type="password" name="user_pass" placeholder="请输入密码.">
              <span></span>
            </div>
          </div>
          <div class="form-group">
            <label for="register_pass" class="col-md-2 control-label">确认密码:</label>
            <div class="col-md-10">
              <input class="form-control" type="password" name="confirmPassword" placeholder="请输入密码.">
              <span></span>
            </div>
          </div>

          <div class="form-group">
            <label for="register_email" class="col-md-2 control-label">电子邮件:</label>
            <div class="col-md-10">
              <input class="form-control" id="register_email" type="text" name="email" placeholder="请输入正确的Email.">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2 control-label" id="captchaOperation"></label>
            <div class="col-md-5">
              <input type="text" class="form-control" name="captcha"/>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm" id="submitBtn">注册</button>
          <button type="button" class="btn btn-warning btn-sm" id="validateBtn">自动验证</button>
          <button type="reset" class="btn btn-info btn-sm" id="resetBtn">重置</button>
        </div>

      </form>

    </div>
  </div>
</div>
<!--注册表单结束-->
<!--登录表单开始-->
<div class="modal fade" id="login_header">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
        <h4 class="text-info text-center">欢迎登录</h4>
      </div>
      <div class="modal-body">
        <form role="form" class="form-horizontal" id="login_form" action="<?php echo U('User/login');?>" method="post">
          <div class="form-group">
            <label for="login_user" class="control-label col-md-2">用户名:</label>
            <div class="col-md-10">
              <input class="form-control" id="login_user" type="text" name="login_user" placeholder="请输入用户名.">
            </div>
          </div>
          <div class="form-group">
            <label for="login_pass" class="control-label col-md-2">密码:</label>
            <div class="col-md-10">
              <input class="form-control" id="login_pass" type="password" name="login_pass" placeholder="请输入密码.">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2 control-label" id="captchaLogin"></label>
            <div class="col-md-5">
              <input type="text" class="form-control" name="captcha"/>
            </div>
          </div>

          <div class="modal-footer">
            <a href="javascript:;" onclick="toQzoneLogin()"><img src="<?php echo C('IMG_URL');?>qq_login.png" style="margin-right: 40%"></a>
            <button type="submit" class="btn btn-success btn-xs">登录</button>
            <button type="reset" class="btn btn-info btn-xs" id="resetLogin">重新填写</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--登录表单结束-->
<!--QQ登录-->
<script type="text/javascript">
  function toQzoneLogin()
  {
    childWindow = window.open("<?php echo C('SITE_URL');?>Common/Plugins/qqlogin/oauth/qq_login.php","TencentLogin","width=580,height=420,top=150,left=400,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
  }

</script>
<!--主体页面开始-->
<div class="container-fluid" style="margin: 10px 0 0 0;">

  <!--主体页面开始-->
  <div class="row">

    <!--左侧手风琴栏-->
    <div class="col-md-2" style="cursor: pointer;">

      <div class="panel-group" id="accordion2">
      </div>

      <div id="code">
        <span class="text-success">[扫一扫，关注作者]</span>
        <img src="<?php echo C('IMG_URL');?>wechat.jpg">
      </div>

    </div>

  <script src="<?php echo C('JS_URL');?>bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo C('JS_URL');?>form/bootstrapValidator.min.js" type="text/javascript"></script>
  <script type="text/javascript">
//ajax获取具体分类
$(function(){
    $.ajax({
        url:'/index.php/Home-Category-cat',
        dataType:'json',
        type:'get',
        success:function(data){
          var str = '';
          $.each(data, function(index, val){
          str += '<div class="panel panel-default" onclick="cat_info('+val.cat_id+')">'+
          '<div class="panel-heading" data-toggle="collapse" data-parent="#accordion2" href="#'+val.cat_id+'">'
          +'<a class="accordion-toggle">'+val.cat_name+'</a></div>'+
          '<div id="'+val.cat_id+'" class="panel-collapse collapse" style="height: 0px;"><div class="panel-body">'+
          '<ul class="nav nav-pills nav-stacked" id="ul-nav-'+val.cat_id+'"></ul></div></div></div>';
            })
           $('#accordion2').append(str);
        }
    });
});

//通过ajax获取对应的分类
function cat_info(cat_id)
{
  var cat_id = cat_id;
  $.ajax({
    url:'/index.php/Home-Category-select',
    dataType:'json',
    data:{'cat_id':cat_id,},
    type:'get',
    success: function(data){
      var str = '';
      $.each(data,function(index, value){
        str += '<li><a href="<?php echo C('SITE_URL');?>'+value.cat_path+'">'+value.cat_name+'</a></li>'
      })
        $('#ul-nav-'+cat_id).html(str);
    },
  });
}
</script>
    <!--左侧手风琴结束-->


    <!--右侧总页面开始-->
<link href="<?php echo C('CSS_URL');?>ajaxpage.css" type="text/css" rel="stylesheet">
<div class="col-md-10">

  <div class="row">

    <div class="col-md-9">

      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
          <li data-target="#tab-chrome" data-side-to="0" class="active"></li>
          <li data-target="#tab-firefox" data-side-to="1"></li>
          <li data-target="#tab-opera" data-side-to="2"></li>
          <li data-target="#tab-ie" data-side-to="3"></li>
        </ol>

        <div class="carousel-inner" role="listbox">

          <div class="item active">
            <a><img src="<?php echo C('IMG_URL');?>roll_1.png" alt="赋兴一首" title="赋兴一首" class="img-thumbnail"></a>
          </div>

          <div class="item">
            <img class="img-thumbnail" src="<?php echo C('IMG_URL');?>roll_2.png" alt="">
          </div>

          <div class="item">
            <img class="img-thumbnail" src="<?php echo C('IMG_URL');?>roll_3.png" alt="">
          </div>

          <div class="item">
            <img class="img-thumbnail" src="<?php echo C('IMG_URL');?>roll_4.png" alt="">
          </div>
        </div>

        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">上一页</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">下一页</span>
        </a>
      </div>
    </div>

    <!--天气和搜索页面-->
    <div class="col-md-3">
      <!--天气页面开始-->
      <div class="row" id="weather">
      </div>
      <!--天气页面结束-->
      <div class="row">

        <div class="col-md-12">
          <div id="search" class="sidebar-block search" role="search">
            <h3 class="text-info text-center">搜索文章</h3>
            <form class="navbar-form" action="search.php" method="post">
              <div class="input-group">
                <input type="text" class="form-control" size="35" placeholder="请输入关键字">
                <span class="input-group-btn">
                 <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                </span>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--天气和搜索页面结束-->

  </div>
  <!--右侧页面第一行结束-->

  <!--首页右侧第二行开始-->
  <div class="row">

    <!--热门博客列开始-->
    <div class="col-md-9">

      <h4 class="text-danger">最近热门</h4>

      <input type="hidden" value="<?php echo ($count); ?>" id="num_entries">
      <div class="row" style="margin-top: 15px;">
        <div class="col-md-12">

          <div id="pageshow">
          </div>

        </div>
      </div>

    </div>
    <!--热门博客列结束-->

    <!--选项卡小功能开始-->
    <div class="col-md-3">

      <h4 class="text-info">最新文章</h4>
      <?php if(is_array($newarticle)): foreach($newarticle as $key=>$val): ?><div class="alert alert-info alert-dismissable" role="alert">
        <button class="close" type="button" data-dismiss="alert">&times;</button>
        <a href="<?php echo U('Article/show',array('id' => $val['article_id']));?>"><?php echo ($val["ac_title"]); ?></a>
      </div><?php endforeach; endif; ?>
      <hr />
      <ul id="myTab" class="nav nav-pills" role="tablist">
        <li class="active"><a href="#bulletin" role="tab" data-toggle="pill">公告</a></li>
        <li><a href="#rule" role="tab" data-toggle="pill">规则</a></li>
        <li><a href="#forum" role="tab" data-toggle="pill">论坛</a></li>
      </ul>
      <!-- 选项卡面板 -->
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active text-info" id="bulletin">暂时没有公告</div>
        <div class="tab-pane fade text-danger" id="rule">没有什么规则</div>
        <div class="tab-pane fade text-success" id="forum">正在开发中</div>
      </div>

    </div>
  </div>
  <!--首页右侧第二列end-->

</div>
<!--右侧总页面结束-->

</div>
</div>
<!--总页面结束-->
<script src="<?php echo C('JS_URL');?>jquery-page.js" type="text/javascript"></script>
<!--无刷新分页调用文章-->
<script type="text/javascript">
  $(function () {

    var initPagination = function () {
      var num_entries = $("#num_entries").val();//记录总条数
      // 创建分页页码列表
      $("#pageshow").pagination(num_entries, {
        num_edge_entries: 1, //边缘页数
        num_display_entries: 4, //主体页数
        callback: pageselectCallback,
        items_per_page: 4 //每页显示1条记录信息
      });
    }();

    function pageselectCallback(page_index, jq) {

      //通过ajax去服务器端获得"第page_index+1页"评论信息回来
      $.ajax({
        url: "/index.php/Home-Article-getArticle",
        data: {'page_index': page_index,},
        dataType: 'json',
        type: 'get',
        success: function (msg) {
          //console.log(msg);
          //遍历msg 使其与html标签结合 并追加给页面
          var str = "";
          $.each(msg, function (index, value) {

            str += '<div class="panel panel-success"><div class="panel-heading" id="article_heading">文章标题：' + value.ac_title + '<span style="margin-left: 60%">阅读次数:<span class="badge">'+value.read_count+'</span></span></div><div id="article_body" class="panel-body">' +
                '<a title="点击查看详情" class="text-info" onclick="showcontent(' + value.article_id + ')">' + value.ac_content.substring(0, 80) + '......</a></div>' +
                '<div class="panel-footer" id="article_footer">作者: <img class="img-circle" title="'+value.user_name+'" style="width: 30px;height: 30px;" src="<?php echo C('SITE_URL');?>'+value.user_small_logo+'" ><span style="margin-left:20%; ">发布时间:' + value.time + '</span></div></div>';
          });
          $('.panel-success').remove();
          $('#pageshow').before(str); //给后边追加兄弟节点
        }
      });
    }

  });

</script>
<script type="text/javascript">
  function showcontent(article_id) {
    var id = article_id;
    window.location.href = '/index.php/Home-Article-show-id-' + id;
  }
</script>
<!--ajax调用天气-->
<script type="text/javascript">

  function weather() {
    $.ajax({
      url: '/index.php/Home-Api-weather',
      dataType: 'json',
      type: 'get',
      success: function (data) {
        var str = '';
        //console.log(data);
        //alert(data.today);错误写法
        //console.log(data.retData.today);
        //$.each(data.retData.today, function(index, value){ });
        //console.log(value);
        str = '<div class="col-md-12"><h4 class="text-info">今日天气 [' + data.retData.city + ']</h4><h4 class="text-danger">' + data.retData.today.date + '&nbsp;&nbsp;' + data.retData.today.week + '</h4>' +
            '<h4>当前温度:' + data.retData.today.curTemp + '</h4>' + '<h4>当前pm值：' + data.retData.today.aqi + '</h4><h4>天气状态: ' + data.retData.today.type + '</h4></div>';

        $('#weather').html(str);
      },

    });
  }

  var _interator;
  $(function () {
    setTimeout(function () {
      weather();
      _interator = setInterval(weather, 1800000);
    }, 0);

  });
</script>

    <!--底部栏开始-->
    <div class="container-fluid">
      <div class="col-md-12">
        <footer class="footer"><p class="text-info text-center">POWERED BY &copy;<a href="http://www.chmake.cn">尘剑隐芒
          chmake.cn</a>&nbsp;&nbsp;&nbsp;<span><a href="http://www.miitbeian.gov.cn/"
                                                  target="_blank">京ICP备16033390号-1</a></span></p></footer>
      </div>
    </div>
  <!--底部栏结束-->

    <div><a href="javascript:;" class="gotop" style="display:none;" title="返回顶部"></a></div>
    <!--/返回顶部-->
    <script src="<?php echo C('JS_URL');?>form/register.js" type="text/javascript"></script>
    <script src="<?php echo C('JS_URL');?>form/login.js" type="text/javascript"></script>
    <script src="<?php echo C('JS_URL');?>weight.js" type="text/javascript"></script>

</html>