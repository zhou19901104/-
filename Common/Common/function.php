<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/1
 * Time: 9:49
 */
	/**
	 * @param $touser 收件人邮箱地址
	 * @param $title 发件标题
	 * @param $content 发件内容
	 * @return bool 返回值
	 * @throws phpmailerException 异常
	 */
	function sendMail($touser, $title, $content, $fromuser)
	{
		//引入发送类phpmailer.php
		require_once './Common/Plugins/PHPMailer/class.phpmailer.php';
		//实列化对象
		$mail = new PHPMailer();
		/*服务器相关信息*/
		$mail->IsSMTP();                        //设置使用SMTP服务器发送
		$mail->SMTPAuth = true;               //开启SMTP认证
		$mail->Host = 'smtp.163.com';         //设置 SMTP 服务器,自己注册邮箱服务器地址
		$mail->Username = 'zhou18937602075';      //发信人的邮箱用户名
		$mail->Password = 'zhou19901104';       //发信人的邮箱密码
		/*内容信息*/
		$mail->IsHTML(true);              //指定邮件内容格式为：html
		$mail->CharSet = "UTF-8";          //编码
		$mail->From = 'zhou18937602075@163.com';       //发件人完整的邮箱名称
		$mail->FromName = $fromuser;      //发信人署名
		$mail->Subject = $title;         //信的标题
		$mail->MsgHTML($content);           //发信主体内容
		// $mail->AddAttachment("fish.jpg");      //附件
		/*发送邮件*/
		$mail->AddAddress($touser);        //收件人邮箱地址
		//使用send函数进行发送
		return $mail->Send();
	}


	/**
	 * 接口请求封装方法
	 * @param $url 请求接口的url
	 * @param bool $https 协议方式
	 * @param string $method 请求方法
	 * @param null $data 传递数据
	 * @return mixed 返回json数据
	 */
	function api($url, $header, $https = true, $method = 'get', $data = null)
	{
		//1.初始化url
		$ch = curl_init($url);
		//2.设置相关的参数
		//字符串不直接输出,进行一个变量的存储
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//判断是否为https请求
		if ($https === true) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}
		//判断是否为post请求
		if ($method == 'post') {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
		//3.发送请求
		$str = curl_exec($ch);
		//4.关闭连接
		curl_close($ch);
		//返回请求到的结果
		return $str;
	}

	/**
	 * @param $string 对$string内容防止xss攻击
	 * @return string 把$string中的非法标签内容都给过滤掉
	 */
	function fangXSS($string)
	{
		require_once './Common/Plugins/htmlpurifier/HTMLPurifier.auto.php';
		// 生成配置对象
		$cfg = HTMLPurifier_Config::createDefault();
		// 以下就是配置：
		$cfg->set('Core.Encoding', 'UTF-8');
		// 设置允许使用的HTML标签
		$cfg->set('HTML.Allowed', 'div,b,strong,i,em,a[href|title],ul,ol,li,br,span[style],img[width|height|alt|src]');
		// 设置允许出现的CSS样式属性
		$cfg->set('CSS.AllowedProperties', 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align');
		// 设置a标签上是否允许使用target="_blank"
		$cfg->set('HTML.TargetBlank', TRUE);
		// 使用配置生成过滤用的对象
		$obj = new HTMLPurifier($cfg);
		// 过滤字符串
		return $obj->purify($string);
	}

/**
 *字符串截取函数
 *最好开启mbstring扩展
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
	if(mb_strlen($str,$charset)>$length)
	{
		if(function_exists("mb_substr")){
			if($suffix)
				return mb_substr($str, $start, $length, $charset)."...";
			else
				return mb_substr($str, $start, $length, $charset);
		}elseif(function_exists('iconv_substr')) {
			if($suffix)
				return iconv_substr($str,$start,$length,$charset)."...";
			else
				return iconv_substr($str,$start,$length,$charset);
		}
		$re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
		$re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
		$re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
		$re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("",array_slice($match[0], $start, $length));
		if($suffix) return $slice."…";
		return $slice;
	}
	else
	{
		return $str;
	}
}

//递归方法实现无限极分类
function getTree($list,$pid=0,$level=0) {
	static $tree = array();
	foreach($list as $key=>$row) {
		if($row['cat_pid']==$pid) {
			$row['cat_level'] = $level;
			$tree[] = $row;
			getTree($list, $row['cat_id'], $level + 1);
		}
	}
	return $tree;
}