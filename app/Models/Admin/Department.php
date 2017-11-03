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

class Department extends Model
{
    //use SoftDeletes;

    protected $table = 'department';

}