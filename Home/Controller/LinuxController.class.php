<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/4
 * Time: 23:50
 */

namespace Home\Controller;


class LinuxController extends CommonController
{
	/**
	 * Linux命令界面
	 */
	public function index()
	{
		$this->display();
	}

	/**
	 * LAMP搭建页面
	 */
	public function lamp()
	{
		$this->display();	
	}
	/**
	 * LAMP常见问题
	 */
	public function problem()
	{
		$this->display();
	}
	/**
	 * LNMP搭建
	 */
	public function lnmp()
	{
		$this->display();
	}

}