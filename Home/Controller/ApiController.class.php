<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/1
 * Time: 12:31
 */

namespace Home\Controller;


class ApiController extends CommonController
{
	/**
	 * 天气接口
	 */
	public function weather()
	{

		$city = '北京';
		$url = 'http://apis.baidu.com/apistore/weatherservice/recentweathers?cityname='.$city;

		$header = array(
			'apikey: c2ef4198126ddbb56040a677dbbb32ba',
		);
		// 添加apikey到header
		$result = api($url,$header,false);
		echo $result;
	}

}