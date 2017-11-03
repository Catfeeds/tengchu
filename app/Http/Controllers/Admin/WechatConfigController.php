<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/23
 * Time: 17:06
 */
namespace App\Http\Controllers\Admin;

use App\Models\Admin\WechatConfig;

class WechatConfigController extends BaseController{

    //列表
    public function index(){
        return view('admin.wechatConfig.index');
    }

    //新增
    public function create(){
        return view('admin.wechatConfig.create');
    }

    //修改
    public function edit($id){
        $id = (int)$id;

        $model = new WechatConfig();
        $info = $model->find($id);
        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该应用不存在!'], 'admin/wechatConfig');

        return view('admin.wechatConfig.edit', compact('info'));
    }

    //详情
    public function show($id){
        $model = new WechatConfig();
        $info = $model->find($id);

        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该应用不存在!'], 'admin/wechatConfig');

        return view('admin.wechatConfig.show', compact('info'));
    }
}