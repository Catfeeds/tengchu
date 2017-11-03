<?php
/**
 * 后台Api路由
 * Author: flycorn
 * Email: ym1992it@163.com
 * Date: 2017/3/5
 * Time: 16:30
 */

Route::post('login', 'LoginController@login'); //登录处理

Route::group(['middleware' => ['fcAdmin.login:admin', 'fcAdmin.auth']], function () {

    //个人中心
    Route::post('ucenter/edit', 'UcenterController@edit'); //修改个人资料
    Route::post('ucenter/password', 'UcenterController@password'); //修改密码
    Route::post('upload/image', 'UploadController@image'); //上传图片

    //管理员
    Route::name('admin.adminUser.index')->get('adminUser', 'AdminUserController@index');
    Route::name('admin.adminUser.create')->post('adminUser', 'AdminUserController@store');
    Route::name('admin.adminUser.edit')->put('adminUser/{id}', 'AdminUserController@update');
    Route::name('admin.adminUser.delete')->delete('adminUser/{id}', 'AdminUserController@destroy');

    //权限
    Route::name('admin.adminPermission.index')->get('adminPermission', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.index')->get('adminPermission/{id}', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.create')->post('adminPermission', 'AdminPermissionController@store');
    Route::name('admin.adminPermission.edit')->put('adminPermission/{id}', 'AdminPermissionController@update');
    Route::name('admin.adminPermission.delete')->delete('adminPermission/{id}', 'AdminPermissionController@destroy');

    //角色
    Route::name('admin.adminRole.auth')->put('adminRole/{id}/auth', 'AdminRoleController@auth'); //角色授权
    Route::name('admin.adminRole.index')->get('adminRole', 'AdminRoleController@index');
    Route::name('admin.adminRole.create')->post('adminRole', 'AdminRoleController@store');
    Route::name('admin.adminRole.edit')->put('adminRole/{id}', 'AdminRoleController@update');
    Route::name('admin.adminRole.delete')->delete('adminRole/{role}', 'AdminRoleController@destroy');

    //微信设置
    Route::name('admin.wechatConfig.index')->get('wechatConfig', 'WechatConfigController@index');
    Route::name('admin.wechatConfig.create')->post('wechatConfig/create', 'WechatConfigController@create');
    Route::name('admin.wechatConfig.edit')->put('wechatConfig/{id}', 'WechatConfigController@update');
    Route::name('admin.wechatConfig.delete')->delete('wechatConfig/{id}', 'WechatConfigController@destroy');

    //前置机设置
    Route::name('admin.preConfig.index')->get('preConfig', 'PreConfigController@index');
    Route::name('admin.preConfig.edit')->put('preConfig/{id}', 'PreConfigController@update');

    //图书列表
    Route::name('admin.book.index')->get('book', 'BookController@index');
    Route::name('admin.book.create')->post('book/create', 'BookController@create');
    Route::name('admin.book.edit')->put('book/{id}', 'BookController@update');
    Route::name('admin.book.delete')->delete('book/{id}', 'BookController@destroy');

    //图书分类
    Route::name('admin.bookClass.index')->get('bookClass', 'BookClassController@index');
    Route::name('admin.bookClass.create')->post('bookClass/create', 'BookClassController@create');
    Route::name('admin.bookClass.edit')->put('bookClass/{id}', 'BookClassController@update');
    Route::name('admin.bookClass.delete')->delete('bookClass/{id}', 'BookClassController@destroy');

    //医院管理
    Route::name('admin.hospital.index')->get('hospital', 'HospitalController@index');
    Route::name('admin.hospital.edit')->put('hospital/{id}', 'HospitalController@update');
    Route::name('admin.hospital.create')->post('hospital/create', 'HospitalController@create');

    //科室管理
    Route::name('admin.department.index')->get('department', 'DepartmentController@index');
    Route::name('admin.department.edit')->put('department/{id}', 'DepartmentController@update');
    Route::name('admin.department.create')->post('department/create', 'DepartmentController@create');
    Route::name('admin.department.delete')->delete('department/{id}', 'DepartmentController@destroy');

    //医生管理
    Route::name('admin.doctor.index')->get('doctor', 'DoctorController@index');
    Route::name('admin.doctor.edit')->put('doctor/{id}', 'DoctorController@update');
    Route::name('admin.doctor.create')->post('doctor/create', 'DoctorController@create');
    Route::name('admin.doctor.delete')->delete('doctor/{id}', 'DoctorController@destroy');

    //订单管理
    Route::name('admin.order.index')->get('order', 'OrderController@index');
    Route::name('admin.order.edit')->put('order/{id}', 'OrderController@update');
    Route::name('admin.order.create')->post('order/create', 'OrderController@create');
    Route::name('admin.order.delete')->delete('order/{id}', 'OrderController@destroy');







    /**
     * other modules
     */
    
});
