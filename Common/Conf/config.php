<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/6/27
 * Time: 13:31
 */
return array(
	//'配置项'=>'配置值'
	'MODULE_ALLOW_LIST' => array('Home', 'Admin'),
	
	'TMPL_L_DELIM'          =>  '<{',            // 模板引擎普通标签开始标记
	'TMPL_R_DELIM'          =>  '}>',            // 模板引擎普通标签结束标记
	//'TMPL_DENY_PHP'      =>true,
	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
	'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
	'DEFAULT_ACTION'        =>  'index', // 默认操作名称
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'DB_HOST'               =>  'rm-bp1u71ps9h0iry5a7.mysql.rds.aliyuncs.com', // 服务器地址
	'DB_NAME'               =>  'r72gyhc016',          // 数据库名
	'DB_USER'               =>  'r72gyhc016',      // 用户名
	'DB_PWD'                =>  'zhou1104',          // 密码
	'DB_PORT'               =>  '3306',        // 端口
	'DB_PREFIX'             =>  'ch_',    // 数据库表前缀
	
	'SHOW_PAGE_TRACE'  =>  false,//开启页面跟踪信息
	
	//配置站点绝对路径
	'SITE_URL' => 'http://www.chmake.cn/',

	'URL_MODEL'             =>  1,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
	'URL_PATHINFO_DEPR'     =>  '-',	// PATHINFO模式下，各参数之间的分割符号
	'UPLOAD_MAX_FILESIZE'=>'2M',//设置允许上传单个文件的大小
	'UPLOAD_ALLOW_EXT'=>array('jpg','jpeg','bmp','gif','png'),//设置允许上传文件的类型


	
	
);