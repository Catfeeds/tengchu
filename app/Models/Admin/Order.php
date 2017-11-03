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

class Order extends Model
{
    //use SoftDeletes;

    protected $table = 'payment';  // 定义表
    protected $primaryKey = 'user_id';  //定义主键


}