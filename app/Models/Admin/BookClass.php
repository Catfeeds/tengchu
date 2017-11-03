<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/31
 * Time: 15:18
 */
namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\FcAdminModel;

class BookClass extends Authenticatable{

    use FcAdminModel;

    protected $table='book_class';


}