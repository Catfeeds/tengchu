<?php
/**
 * 后台路由
 * Author: chance
 * Date: 2017/3/5
 * Time: 16:30
 */

Route::name('wap.user.index')->get('user', 'UserController@index');
//Route::get('user', 'UserController@index'); //登录页

