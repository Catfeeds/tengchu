<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/31
 * Time: 15:18
 */
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    //use SoftDeletes;

    protected $table = 'doctor';

    public $timestamps = false;  //关闭
    //设置当前时间戳
    protected function getDateFormat(){
        return time();
    }
    //默认显示时间戳,不做任何处理
    protected function  asDateTime($val){
        return $val;
    }

}