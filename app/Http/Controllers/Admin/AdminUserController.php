<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminUserController extends BaseController
{
    /**
     * 管理员列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.adminUser.index');
    }

    /**
     * 添加管理员
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $role_list = $this->adminRoleService->roleList();
        //获取医院列表
        $hospital = $this->hospitalService->selectHospitalList('id','ASC');
        //dd($hospital);
        return view('admin.adminUser.create', compact('role_list','hospital'));
    }

    /**
     * 管理员详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        $id = (int)$id;

        $user = $this->adminUserService->adminData($id);
        //验证
        if(empty($user)) return $this->tool->response(['status' => 0, 'msg' => '该管理员不存在!'], 'admin/adminUser');

        //角色列表
        $role_list = $this->adminRoleService->roleList();
        return view('admin.adminUser.show', compact('user', 'role_list'));
    }

    /**
     * 编辑管理员
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $id = (int)$id;

        $user = $this->adminUserService->adminData($id);
        //验证
        if(empty($user)) return $this->tool->response(['status' => 0, 'msg' => '该管理员不存在!'], 'admin/adminUser');

        if($user->id == 1) return $this->tool->response(['status' => 0, 'msg' => '超级管理员不能修改!'], 'admin/adminUser');

        //获取医院列表
        $hospital = $this->hospitalService->selectHospitalList('id','ASC');

        //角色列表
        $role_list = $this->adminRoleService->roleList();
        $user_role_ids = array_column($this->adminUserService->adminRoles($user)->toArray(), 'id');

        return view('admin.adminUser.edit', compact('user', 'role_list', 'user_role_ids','hospital'));
    }

}
