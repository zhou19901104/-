<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<{:C('CSS_URL')}>bootstrap.min.css" type="text/css" rel="stylesheet">

	<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background:url('../../Public/Home/images/404-background.jpg') no-repeat; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<?php if(isset($message)) {?>

<div style="margin-top:100px;" class="text-center">

<p class="success text-success"><?php echo($message); ?></p>
<h3 class="text-info ">今日赠言</h3>
成功无须得意！
</div>

<?php }else{?>

<div style="margin-top:100px;" class="text-center">
<p class="error text-danger"><?php echo($error); ?></p>
<h3 class="text-info ">今日赠言</h3>
失败无须失意！
</div>
<?php }?>
<p class="detail"></p>
<p class="jump text-center">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>
