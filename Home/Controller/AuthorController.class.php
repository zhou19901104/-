<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/5
 * Time: 16:03
 */

namespace Home\Controller;


class AuthorController extends CommonController
{
	/**
	 * 展示作者页面
	 */
	public function index()
	{
		$author = D('Author');
		$count = $author->count();
		
		$this->assign('count', $count);
		$this->display();
	}

	/**
	 * 展示作者评论页面
	 */
	public function addCmt()
	{
		$data['comment'] = fangXSS($_POST['comment']);
		$data['addtime'] = time();
		if(empty($data['comment'])){
			return false;
		}
		$author = D('Author');
		if($newid = $author->add($data)){
			$cmtinfo = $author
								->find($newid);
			
			$this->ajaxReturn($cmtinfo);
		}
	}

	/**
	 * 显示评论界面
	 */
	public function getCmtList()
	{
		$page_index = I('get.page_index');
		$pageSize = 6;
		$info = D('Author')
						->field('id,comment,left(from_unixtime(addtime),16)')
						->limit($page_index*$pageSize, $pageSize)
						->order('id DESC')
						->select();

		$this->ajaxReturn($info);
	}
	
}