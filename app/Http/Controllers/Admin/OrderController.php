<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/31
 * Time: 15:17
 */
namespace App\Http\Controllers\Admin;

use App\Models\Admin\Order;
use App\Services\Admin\OrderService;
use Illuminate\Support\Facades\DB;


class OrderController extends BaseController{


    //列表
    public function index()
    {
        return view('admin.order.index');
    }

    //新增
    public function create()
    {

        return view('admin.department.create');
    }

    //修改
    public function edit($id)
    {
        $id = (int)$id;
        $model = new Order();
        $info = $model->find($id);
        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该科室不存在!'], 'admin/department');

        return view('admin.department.edit', compact('info'));
    }

    //详情
    public function show($id){
        $model = new Order();
        $info = $model->find($id);
        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该记录不存在!'], 'admin/order');
        return view('admin.order.show', compact('info'));
    }


}