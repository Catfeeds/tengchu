<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/24
 * Time: 10:00
 */
namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\FcAdminModel;

class PreConfig extends Authenticatable{

    use FcAdminModel;

    protected $table='serverconfig';

    public $timestamps = false;  //关闭
}