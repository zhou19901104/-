<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/6
 * Time: 15:53
 */

namespace Home\Controller;


class EchartsController extends CommonController
{
	/**
	 * 注册会员分布图
	 */
	public function rose()
	{
		$this->display();
	}

	/**
	 * 返回城市数据
	 */
	public function province()
	{
		$user = D('User');
		$data = $user
			->alias('u')
			->field('count(p.name) as count,p.name')
			->join('__PROVINCE__ as p on u.province=p.code')
			->where('u.province = p.code')
			->group('province')
			->select();
		$this->ajaxReturn($data);
	}
}