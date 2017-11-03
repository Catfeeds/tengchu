<?php
/**
 * 后台路由
 * Author: flycorn
 * Email: ym1992it@163.com
 * Date: 2017/3/5
 * Time: 16:30
 */

//登录
Route::get('captcha', 'CaptchaController@index'); //登录验证码
Route::get('login', 'LoginController@index'); //登录页
Route::get('logout', 'LoginController@logout'); //退出

Route::group(['middleware' => ['fcAdmin.login:admin', 'fcAdmin.permission', 'fcAdmin.auth']], function () {

    //基础路由
    Route::get('/', 'IndexController@index');
    Route::get('ucenter', 'UcenterController@index'); //个人中心

    //系统管理
    Route::name('admin.system.index')->get('system', 'SystemController@index');

    //管理员管理
    Route::name('admin.adminUser.index')->get('adminUser', 'AdminUserController@index');
    Route::name('admin.adminUser.create')->get('adminUser/create', 'AdminUserController@create');
    Route::name('admin.adminUser.edit')->get('adminUser/{id}/edit', 'AdminUserController@edit');
    Route::name('admin.adminUser.show')->get('adminUser/{id}', 'AdminUserController@show');

    //权限管理
    Route::name('admin.adminPermission.index')->get('adminPermission', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.create')->get('adminPermission/create', 'AdminPermissionController@create');
    Route::name('admin.adminPermission.index')->get('adminPermission/{id}', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.create')->get('adminPermission/{id}/create', 'AdminPermissionController@create');
    Route::name('admin.adminPermission.show')->get('adminPermission/{id}/show', 'AdminPermissionController@show');
    Route::name('admin.adminPermission.edit')->get('adminPermission/{id}/edit', 'AdminPermissionController@edit');

    //角色管理
    Route::name('admin.adminRole.auth')->get('adminRole/{id}/auth', 'AdminRoleController@auth'); //角色授权
    Route::name('admin.adminRole.index')->get('adminRole', 'AdminRoleController@index');
    Route::name('admin.adminRole.create')->get('adminRole/create', 'AdminRoleController@create');
    Route::name('admin.adminRole.show')->get('adminRole/{id}', 'AdminRoleController@show');
    Route::name('admin.adminRole.edit')->get('adminRole/{id}/edit', 'AdminRoleController@edit');

    //微信管理
    Route::name('admin.wechat.index')->get('wechat', 'WechatController@index');

    //微信设置
    Route::name('admin.wechatConfig.index')->get('wechatConfig', 'WechatConfigController@index');
    Route::name('admin.wechatConfig.create')->get('wechatConfig/create', 'WechatConfigController@create');
    Route::name('admin.wechatConfig.edit')->get('wechatConfig/{id}/edit', 'WechatConfigController@edit');
    Route::name('admin.wechatConfig.show')->get('wechatConfig/{id}', 'WechatConfigController@show');

    //前置机设置
    Route::name('admin.preConfig.index')->get('preConfig', 'preConfigController@index');
    Route::name('admin.preConfig.edit')->get('preConfig/{id}/edit', 'preConfigController@edit');

    //产品管理
    Route::name('admin.product.index')->get('product', 'ProductController@index');

    //图书列表
    Route::name('admin.book.index')->get('book', 'BookController@index');
    Route::name('admin.book.create')->get('book/create', 'BookController@create');
    Route::name('admin.book.edit')->get('book/{id}/edit', 'BookController@edit');
    Route::name('admin.book.show')->get('book/{id}', 'BookController@show');

    //图书分类
    Route::name('admin.bookClass.index')->get('bookClass', 'BookClassController@index');
    Route::name('admin.bookClass.create')->get('bookClass/create', 'BookClassController@create');
    Route::name('admin.bookClass.edit')->get('bookClass/{id}/edit', 'BookClassController@edit');
    Route::name('admin.bookClass.show')->get('bookClass/{id}', 'BookClassController@show');

    //医院管理
    //Route::name('admin.hospital.index')->get('hospital', 'HospitalController@index');
    Route::name('admin.hospitalInfo.index')->get('hospitalInfo', 'HospitalController@index');
    Route::name('admin.hospital.edit')->get('hospital/{id}/edit', 'HospitalController@edit');
    Route::name('admin.hospital.create')->get('hospital/create', 'HospitalController@create');

    //科室管理
    Route::name('admin.department.index')->get('department', 'DepartmentController@index');
    Route::name('admin.department.edit')->get('department/{id}/edit', 'DepartmentController@edit');
    Route::name('admin.department.create')->get('department/create', 'DepartmentController@create');

    //医生管理
    Route::name('admin.doctor.index')->get('doctor', 'DoctorController@index');
    Route::name('admin.doctor.edit')->get('doctor/{id}/edit', 'DoctorController@edit');
    Route::name('admin.doctor.create')->get('doctor/create', 'DoctorController@create');

    //订单管理
    Route::name('admin.order.index')->get('order', 'OrderController@index');
    Route::name('admin.order.edit')->get('order/{id}/edit', 'OrderController@edit');
    Route::name('admin.order.create')->get('order/create', 'OrderController@create');
    Route::name('admin.order.show')->get('order/{id}', 'OrderController@show');





    /**
     * other modules
     */
    
});

