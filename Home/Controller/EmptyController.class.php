<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/5
 * Time: 15:07
 */

namespace Home\Controller;


class EmptyController extends CommonController
{
	public function _empty()
	{
		$this->display('Empty/index');
	}

}