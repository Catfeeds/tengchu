<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/31
 * Time: 15:12
 */
namespace App\Http\Controllers\Admin;

class ProductController extends BaseController{

    //初始化
    protected function _init()
    {
        //设置中间件
        $this->middleware(['fcAdmin.login:admin', 'fcAdmin.permission']);
    }

    public function index()
    {
        return redirect('admin');
    }
}
