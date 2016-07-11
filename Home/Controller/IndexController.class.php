<?php

/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/6/27
 * Time: 13:34
 */
namespace Home\Controller;

class IndexController extends CommonController
{

		public function index()
		{
			$article = D('Article');
			$category = D('Category');
			$count = $article
						->where(array('ac_active' => 1))
						->count();
			//取出最新发布的文章
			$newarticle = $article
						->field('from_unixtime("ac_time"),article_id,ac_title,ac_active,read_count')
						->where(array('ac_active' => 1))
						->order('ac_time DESC')
						->limit('0,4')
						->select();

			//取出分类信息
			$catinfo = $category
				  ->field('cat_id,cat_name,cat_pid')
			                ->where(array('cat_pid' => 0))
			 	  ->select();
			$this->assign('catinfo', $catinfo);
			$this->assign('newarticle', $newarticle);
			$this->assign('count', $count);
			$this->display();
		}

}