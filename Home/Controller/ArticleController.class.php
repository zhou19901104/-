<?php
/**
 * Created by PhpStorm.
 * User: 低语
 * Date: 2016/7/1
 * Time: 11:45
 */

namespace Home\Controller;


class ArticleController extends CommonController
{
	/**
	 * 取出数据库中的文章
	 */
	public function getArticle()
	{
		$page_index = I('get.page_index');
		$pageSize = 4;
		$info = D('Article')
			->alias('a')
			->field('a.article_id,a.user_id,a.ac_title,a.ac_content,from_unixtime(a.ac_time) as time,a.read_count,a.ac_active,u.user_name,u.user_small_logo')
			->join('__USER__ as u on a.user_id = u.user_id')
			//->join('__COMMENT__ as c on c.article_id= a.article_id')
			->where('a.ac_active=1')
			->limit($page_index*$pageSize, $pageSize)
			->order('a.read_count DESC')
			->select();
		//dump($info);die();
		$this->ajaxReturn($info);
	}

	/**
	 * 通过id查找对应的文章
	 */
	public function show()
	{
		$id = I('get.id');
		//dump($id);
		$article = D('Article');
		$data = $article
					->alias('a')
					->field('a.*,count(c.article_id) as count')
					->join('__COMMENT__ as c on c.article_id = a.article_id')
					->where(array('a.article_id' => $id,'a.ac_active' => 1))
					->find();
		$article->where(array('article_id' => $id))
						->setInc('read_count');
		$this->assign('data', $data);

		//dump($data);die();
		$this->display();

	}

	/**
	 * 获取对应文章的评论
	 */
	public function getComment()
	{
		$page_index = I('get.page_index');
		$article_id = I('get.article_id');
		$pageSize = 10;
		$info = D('Comment')
			->alias('c')
			->field('c.comcontent,left(from_unixtime(c.comm_time),10) as time,c.comment_id,c.user_id,u.nick_name')
			->join('__USER__ as u on u.user_id = c.user_id')
			->where(array('c.article_id' => $article_id))
			->limit($page_index*$pageSize, $pageSize)
			->order('c.comment_id DESC')
			->select();
		$this->ajaxReturn($info);
	}

	/**
	 * 添加评论
	 */
	public function addComment()
	{
		$comment = D('Comment');
		$data['comcontent'] = fangXSS($_POST['comment']);
		if(empty($data['comcontent'])){
			return false;
		}
		$data['comm_time'] = time();
		$data['user_id'] = session('user_id');
		$data['article_id'] = $_POST['article_id'];
		if($newid = $comment->add($data)){
			$cominfo = $comment
							 ->alias('c')
							 ->field('c.*,u.nick_name')
							 ->join('__USER__ as u on u.user_id= c.user_id')
				       ->find($newid);
			$this->ajaxReturn($cominfo);
		}
	}
	/**
	 * 点赞功能
	 */
	public function add_doll()
	{

		$id = I('get.article_id');
		//当session存在时 不能继续点赞
		if(!empty(session('ac_'.$id))){
			return false;
		}
		$article = D('Article');

		$article->where(array('article_id' => $id))
						->setInc('ac_doll');

		session('ac_'.$id, $id);
			$count = $article
							->field('ac_doll')
							->find($id);
		$this->ajaxReturn($count);
	}
	/**
	 * 文章写入
	 */
	public function write()
	{
		if(IS_POST){
			$comment = $_POST['comment'];
			$ac_title = I('post.ac_title');
			
			if(empty($comment) || empty($ac_title)){
					return false;
			}
				$data = array(
								'user_id' => session('user_id'),
								'ac_title' => $ac_title,
								'ac_content' => $comment,
								'ac_time' => time(),
				);
			if($newId = D('Article')->add($data)){
					$this->ajaxReturn($newId);
			}else{
				return false;
			}
		}
		
		$this->display();
	}
}