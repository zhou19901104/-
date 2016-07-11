<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/1
 * Time: 8:28
 */

namespace Home\Model;


use Think\Model;

class UserModel extends Model
{
	protected $_validate = array(
		array('user_name','require','用户名不能为空'),
		array('user_name','','用户名已经存在',1,'unique'),
		array('user_name','checkName','用户名中含有非法字符',1,'callback'),
		array('user_pass','6,12','密码的长度要在6到12位之间',1,'length'),
		array('confirmPassword','user_pass','两次密码输入不一致',1,'confirm'),
		array('email','require','邮箱不能为空'),
		array('email','email','邮箱格式不合法'),
		array('captcha','require','答案不能为空'),
		array('nick_name','require','昵称不能为空哦！'),
		array('nick_name','checkName','昵称中含有非法字符',1,'callback'),
		array('nick_name','0,10','昵称不能太长',1,'length'),
		array('mobile','0,20','联系方式要在0到20位之间',1,'length'),
		array('sex','require','性别不能为空'),
		
	);

	protected function checkName($name){
		//如果名称中含有@ . * 就不合法
		if(strpos($name,'@')!==false || strpos($name,'.')!==false || strpos($name,'*')!==false){
			//已经存在非法的字符
			return false;
		}
		return true;
	}

	protected function _after_insert($data, $options)
	{
		$title = '新会员激活账户';
		//激活账户的校验码，防止重复恶意激活
		$code = md5(time().$data['user_id']);
		$address = $data['email'];

		$fromuser = '尘剑~博客';
		$url = C('SITE_URL').U('User/activeUser',array('user_id' => $data['user_id'],'code' => $code));

		$content = "你好,请点击<a href='".$url."' target='_blank'>激活按钮</a>激活你的账号";

		if(sendMail($address, $title, $content, $fromuser)){
			$arr = array(
				'user_id' => $data['user_id'],
				'user_uniqd' => $code,
			);
			$this->save($arr);
		}

	}
	//完成用户登录
	public function login(){
		//接收传递的用户名和密码
		$username = I('post.login_user');
		$password = I('post.login_pass');
		//思路根据用户名查找出用户的信息，输出的密码和数据库的中的密码进行匹配
		$info = $this
			->field('is_active,user_name,user_id,user_name,user_pass,user_small_logo,user_uniqd')
			->where("user_name='$username'")
			->find();
		if($info){
			//说明该用户存在，
			//判断该用户是否激活，如果没有激活则禁止登录
			if($info['is_active']==0){
				$this->error='该用户没有激活,请去邮箱激活后登录';
				return false;
			}
			//验证密码是否合法
			if($info['user_pass']==md5(sha1($password))){
				//已经登录成功
				session('user_name', $username);
				session('user_id', $info['user_id']);
				session('user_uniqd',$info['user_uniqd']);
				session('user_small_logo',$info['user_small_logo']);
				return true;
			}
		}
		$this->error='用户名或密码错误';
		return false;
	}


	
}