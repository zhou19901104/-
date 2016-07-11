<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/1
 * Time: 8:22
 */

namespace Home\Controller;


class UserController extends CommonController
{
	/**
	 * 用户注册模块
	 */
	public function register()
	{

		if (IS_POST) {
			$usermodel = D('User');
			if ($usermodel->create()) {
				$pwd = I('post.user_pass');
				$usermodel->user_pass = md5(sha1($pwd));
				//通过数据验证
				if ($usermodel->add()) {
					//注册成功
					$this->success('成功注册，请到邮箱激活账户', U('Index/index'), 2);
				} else {
					$this->error('注册失败');
				}
			} else {
				$this->error($usermodel->getError());
			}
		}
	}

	/**
	 * 用户账户激活模块
	 */
	public function activeUser()
	{
		//1.使用linux crontab 设置定时任务
		//2.账户激活后不能重复激活
		$user_id = I('get.user_id');
		$code = I('get.code');
		$cat['user_id'] = $user_id;
		$cat['user_uniqd'] = $code;

		$userinfo = D('User')
							->where($cat)
							->find();
			if($userinfo){
			$arr = array(
				'user_id' => $user_id,
				'member_id' => $user_id,
				'is_active' => 1,
			);
			//如果该用户已经激活，则无需激活
			if($userinfo['is_active']==1){
				$this->error('该用户已经激活，无需激活', U('Index/index'),2);
			}

			if(D('User')->save($arr)){
				$this->success('激活成功',U('Index/index'),2);
			}else{
				$this->error('激活失败，请联系系统管理员',U('Index/index'),2);
			}

		}else{
			exit('不要非法激活哦!!');
		}
	}

	/**
	 * 用户登录实现及验证
	 */
	public function login()
	{
		if(IS_POST){
			$usermodel = D('User');
			if($usermodel->login()){
				//登录成功
				$this->redirect('Index/index');
			  //$this->success('登录成功,',U('Index/index'),8);
			}else{
				$this->error($usermodel->getError());
			}
		}
	}
		/**
	 * QQ登录方法
	 */
	public function qq_login()
	{
		$token = $_SESSION['access_token'];
		$openid = $_SESSION['openid'];
		//获取QQ账号信息,并持久化
		$url = C('SITE_URL').'Common/Plugins/qqlogin/User/get_user_info.php?access_token='.$token.'&openid='.$openid;
		//获取数据，向其它地址请求
		$qqinfo = file_get_contents($url);//返回json数据
		//json -> array()
		$qqinfo_arr = json_decode($qqinfo,true);
		//把QQ信息存储到数据库
		//qq账号没有就insert 有就update更新 通过openid判断
		$userinfo = D('User')
			    ->where(array('openid' => $openid))
			    ->find();
		if($userinfo === null){
		//qq记录不存在
		$arr = array(
			'nick_name' => $qqinfo_arr['nickname'],
			'sex' => $qqinfo_arr['gender'],
			'openid' => $openid,
			'last_time' => time(),
			);
		$newid = D('User')->add($arr);
		}else{
		//qq记录已经存在
		$newid = $userinfo['user_id'];
		$arr = array(
			'user_id' => $newid,
			'nick_name' => $qqinfo_arr['nickname'],
			'sex' => $qqinfo_arr['gender'],
			'openid' => $openid,
			'last_time' => time(),
			);
		$newid = D('User')->save($arr);
		}
		//信息持久化操作
		session('user_id', $newid);
		session('nick_name', $qqinfo_arr['nickname']);
		$this->redirect('Index/index');
	}
	/**
	 * 处理用户退出登录
	 */
	public function logout()
	{
		session(null);
		$this->redirect('Index/index');
		exit();
	}

	/**
	 * 查询省份信息
	 */
	public function province()
	{
		$prov = D('Province');
		$data = $prov
			->where('2>1')
			->select();
		$this->ajaxReturn($data);

	}

	/**
	 * 查询市区信息
	 */
	public function city()
	{
		$code = I('get.provincecode');
		$city = D('City');
		$data = $city
			->where(array('provincecode' => $code))
			->select();
		$this->ajaxReturn($data);
	}

	/**
	 * 查看县城信息
	 */
	public function area()
	{
		$code = I('get.citycode');
		$area = D('Area');
		$data = $area
			->where(array('citycode' => $code))
			->select();
		$this->ajaxReturn($data);
	}

	/**
	 * 个人信息修改以及查看
	 */
	public function userinfo()
	{
		$user = D('User');
		if(IS_POST){
			//dump($_POST);
			$data = I('post.');
			$data['user_id'] = session('user_id');

			//调用图片缩略图
			$this->_user_logo($data);

			if($user->save($data)){
					$this->redirect('Index/index');
				}else{
					$this->error('修改信息失败,再尝试一次试试！',U('User/userinfo'),2);
				}

			}else{
				$id = session('user_id');
				$user_uniqd = session('user_uniqd');
				$data = $user
							->where(array('user_id' => $id,'user_uniqd' => $user_uniqd))
							->find();
				if($data){

					$this->assign('data', $data);
					$this->display();
				}else{
					$this->redirect('Index/index');
				}

			}

	}

	protected function _user_logo(&$data){
		//dump($_FILES);
		if($_FILES['user_logo']['error']===0){
			//如果是"修改照片"还上传新logo图片
			//就要判断并删除旧logo物理图片
		if(!empty($_FILES['user_logo'])){
								//修改头像
					$old_logo = D('User')
										->field('user_big_logo,user_small_logo')
										->find($data['user_id']);
				unlink($old_logo['user_small_logo']);
				unlink($old_logo['user_big_logo']);
				}

			//A. logo图片上传
			//附件没有问题，才进行后续处理
			$cfg = array(
				'rootPath'      => UPLOAD_PATH, //保存根路径
			);
			$upload = new \Think\Upload($cfg);
			//dump($_FILES['user_logo']);
			$load = $upload -> uploadOne($_FILES['user_logo']);
			//dump($upload);
			//把上传好的附件保存到数据库中(保存路径名信息而已)
			$user_logo = $upload->rootPath.$load['savepath'].$load['savename'];
			$data['user_big_logo'] = $user_logo;

			//B. 给logo图片做缩略图
			$img = new \Think\Image();
			//①创建对象
			$img -> open($user_logo);    //②打开原图
			//$img -> thumb(120,120);          //③做缩略图,6：固定尺寸缩放
			$img -> thumb(120,120);          //③做缩略图,6：固定尺寸缩放
			//原图：./Public/logo/2016-05-24/5743af3fa9667.jpg
			//缩略图：./Public/logo/2016-05-24/s_5743af3fa9667.jpg
			$user_small_logo = $upload->rootPath.$load['savepath'].'thumb_'.$load['savename'];
			$img -> save($user_small_logo);  //④输出保存缩略图
			//保存缩略图到数据库
			session('user_small_logo', $user_small_logo);
			$data['user_small_logo'] = $user_small_logo;

		}

	}

}