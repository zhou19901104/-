<?php

namespace Home\Controller;

class CategoryController extends CommonController
{
    /**
     * 查询二级分类
     */
    public function select()
    {
        $cat_id = I('get.cat_id');
        $data = D('Category')
                    ->where(array('cat_pid' => $cat_id))
                    ->select();
          $this->ajaxReturn($data);
    }

    /**
     * 查询一级分类
     */
    public function cat()
    {
        $cat = D('Category')
                 ->where(array('cat_pid' => 0))
                 ->select();

                 $this->ajaxReturn($cat);
    }

}