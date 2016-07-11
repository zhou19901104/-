<?php if (!defined('THINK_PATH')) exit();?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title></title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <link rel="shortcut icon" href="<?php echo C('IMG_URL');?>icon/favicon.ico">
  <link type="text/css" href="<?php echo C('CSS_URL');?>bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo C('CSS_URL');?>animate.min.css" rel="stylesheet">
  <link href="<?php echo C('CSS_URL');?>style.min862f.css" rel="stylesheet">
  <link href="<?php echo C('CSS_URL');?>font-awesome.min93e3.css" rel="stylesheet">
  <link href="<?php echo C('CSS_URL');?>style.css" rel="stylesheet">
  <script src="<?php echo C('JS_URL');?>jquery-2.1.4.min.js" type="text/javascript"></script>
  <link href="<?php echo C('CSS_URL');?>ajaxpage.css" type="text/css" rel="stylesheet">
  <style type="text/css">
    body {
      font-size: 14px;
    }
  </style>
</head>
<body class="gray-bg">
<div class=" container wrapper wrapper-content animated fadeInRight article">
  <div class="row">
    <div class="col-md-9">
      <div class="ibox-content">
        <div class="pull-right">
          <a href="javascript:;">阅读次数：<span class="badge"><?php echo ($data["read_count"]); ?></span></a>
          <a href="javascript:;" title="点赞">点赞：<span class="badge" id="ac_doll" onclick="add_doll()"><?php echo ($data["ac_doll"]); ?></span></a>
        </div>
        <div class="text-center article-title"><h2><?php echo ($data["ac_title"]); ?></h2></div>
        <?php echo ($data["ac_content"]); ?>
        <input type="hidden" value="<?php echo ($data["article_id"]); ?>" id="article_id">
        <input type="hidden" value="<?php echo ($data["count"]); ?>" id="comcount">
        <hr>

          <?php if(!empty($_SESSION['user_id'])): ?><textarea style="height: 30%;" id="article_content" name="article_content"></textarea>
           <button class="btn btn-info" onclick="add_comment()" style="margin: 5px 0 0 80%;">发表评论</button>
          <?php else: ?>
            <li class="list-group text-danger" name="list"><a href="<?php echo U('Index/index');?>">登陆后才可以对文章评论！</a></li><?php endif; ?>
      </div>
    </div>

    <input type="hidden" value="" id="comment_count">
    <div class="col-md-3" id="article_comment">
      <li class="list-group text-danger" name="list">欢迎对文章评论哦...</li>
      <div id="pageshow"></div>
    </div>
  </div>

  <div class="row">

  </div>

</div>

</body>
<!--底部栏开始-->
<div class="container-fluid">
  <div class="col-md-12">
    <footer class="footer"><p class="text-info text-center">POWERED BY &copy;<a href="http://www.chmake.cn">尘剑隐芒
      chmake.cn</a>&nbsp;&nbsp;&nbsp;<span><a href="http://www.miitbeian.gov.cn/"
                                              target="_blank">京ICP备16033390号-1</a></span></p></footer>
  </div>
</div>
<!--底部栏结束-->


<script src="<?php echo C('JS_URL');?>bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo C('JS_URL');?>content.min.js?v=1.0.0"></script>
<script src="<?php echo C('JS_URL');?>jquery-page.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>uEditor/ueditor.config.js"></script>
<script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>uEditor/ueditor.all.min.js"></script>
<script type="text/javascript" src="<?php echo C('PLUGIN_URL');?>uEditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
  //文章点赞
  function add_doll() {
    var article_id = $('#article_id').val();
    $.ajax({
      url: '/index.php/Home-Article-add_doll',
      dataType: 'json',
      data: {'article_id': article_id},
      type: 'get',
      success: function (data) {
        $('#ac_doll').html(data.ac_doll);
      },
    });
  }

  $(function () {

    var initPagination = function () {
      var num_entries = $("#comcount").val();//记录总条数
      // 创建分页页码列表
      $("#pageshow").pagination(num_entries, {
        num_edge_entries: 1, //边缘页数
        num_display_entries: 4, //主体页数
        callback: pageselectCallback,
        items_per_page: 10 //每页显示1条记录信息
      });
    }();

    function pageselectCallback(page_index, jq) {
      var article_id = $('#article_id').val();
      //通过ajax去服务器端获得"第page_index+1页"评论信息回来
      $.ajax({
        url: "/index.php/Home-Article-getComment",
        data: {'page_index': page_index, 'article_id': article_id,},
        dataType: 'json',
        type: 'get',

        success: function (msg) {
          //console.log(msg);
          //遍历msg 使其与html标签结合 并追加给页面
          var str = "";
          $.each(msg, function (index, value) {
            //console.log(value);
            str += '<li class="list-group-item"><span class="text-success">' + value.nick_name+ '</span><br/> ' + value.comcontent + '</li>';
          });
          //清除旧的div
          $('.list-group-item').remove();
          //追加评论(回复)信息新div到页面
          $('#pageshow').before(str); //给后边追加兄弟节点
        }
      });
    }
  });
</script>

<script type="text/javascript">
  //发表评论
  function add_comment() {
    //富文本编辑器通过以下方式获得内容
    var comment = UE.getEditor('article_content').getContent();
    var article_id = $('#article_id').val();
    if (comment !== null || comment !== undefined) {
      //② 通过ajax传递内容到服务器端存储
      $.ajax({
        url: "/index.php/Home-Article-addComment",
        data: {'comment': comment, 'article_id': article_id},
        dataType: 'json',
        type: 'post',
        success: function (msg) {
          //console.log(msg);
          var str = '';
          str += ' <li class="list-group-item"><span class="text-success">' + msg.nick_name + '</span>:<br /> ' + msg.comcontent + '</li>';
          $('.list-group').after(str); //兄弟追加
          UE.getEditor('article_content').setContent(''); //富文本编辑器内容清空

        },
        error:function () {
          alert('评论内容不能为空');
        },
      });
    }
  }

  var ue = UE.getEditor('article_content', {
    toolbars: [[
      'fullscreen', 'source', '|', 'undo', 'redo', '|',
      'bold', 'italic', 'underline', 'fontborder', 'strikethrough', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
      'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
      'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
      'directionalityltr', 'directionalityrtl', 'indent', '|',
      'justifyleft', 'touppercase', 'tolowercase', '|',
      'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
      'simpleupload', 'insertimage', 'emotion',
      'horizontal'
    ]]
  });
</script>

</html>