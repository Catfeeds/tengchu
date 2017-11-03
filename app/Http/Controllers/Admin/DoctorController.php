<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2017/5/31
 * Time: 15:17
 */
namespace App\Http\Controllers\Admin;

use App\Models\Admin\Doctor;
use App\Services\Admin\DoctorService;
use Illuminate\Support\Facades\DB;


class DoctorController extends BaseController{


    //列表
    public function index()
    {
        //获取医院列表
        $hospital = $this->hospitalService->selectHospitalList('id','ASC');
        return view('admin.doctor.index',compact('hospital'));
    }

    //新增
    public function create()
    {

        return view('admin.doctor.create');
    }

    //修改
    public function edit($id)
    {
        $id = (int)$id;
        $model = new Doctor();
        $info = $model->find($id);
        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该医生不存在!'], 'admin/doctor');

        return view('admin.doctor.edit', compact('info'));
    }

    //详情
    public function show($id){
        $model = new Department();
        $info = $model->find($id);
        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该科室不存在!'], 'admin/department');
        return view('admin.department.edit', compact('info'));
    }


}