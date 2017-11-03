<?php
/**
 * 后台接口控制器基类
 * Class BaseController
 * @package App\Http\Controllers\Admin
 */

namespace App\Http\Controllers\AdminApi;

use App\Services\Admin\AdminPermissionService;
use App\Services\Admin\AdminRoleService;
use App\Services\Admin\AdminUserService;
use App\Http\Controllers\Controller;
use App\Libs\FcAdmin\Tool;
use App\Services\Admin\BookClassService;
use App\Services\Admin\BookService;
use App\Services\Admin\HospitalService;
use App\Services\Admin\DepartmentService;
use App\Services\Admin\DoctorService;
use App\Services\Admin\PreConfigService;
use App\Services\Admin\OrderService;
use App\Services\DataTableService;

class BaseController extends Controller
{
    use DataTableService;

    protected $tool;

    protected $adminUserService;
    protected $adminPermissionService;
    protected $adminRoleService;
    protected $bookService;
    protected $bookClassService;
    protected $hospitalService;
    protected $departmentService;
    protected $doctorService;
    protected $preConfigService;
    protected $orderService;

    public function __construct(
        AdminUserService $adminUserService,
        AdminPermissionService $adminPermissionService,
        AdminRoleService $adminRoleService,
        Tool $tool,
        BookService $bookService,
        BookClassService $bookClassService,
        HospitalService $hospitalService,
        DepartmentService $departmentService,
        DoctorService $doctorService,
        PreConfigService $preConfigService,
        OrderService $orderService
    )
    {
        //依赖注入服务
        $this -> adminUserService = $adminUserService;
        $this -> adminPermissionService = $adminPermissionService;
        $this -> adminRoleService = $adminRoleService;
        $this -> bookService = $bookService;
        $this -> bookClassService = $bookClassService;
        $this -> hospitalService = $hospitalService;
        $this -> departmentService = $departmentService;
        $this -> doctorService = $doctorService;
        $this -> preConfigService = $preConfigService;
        $this -> orderService = $orderService;

        //后台工具类
        $this->tool = $tool;

        //控制器初始化
        $this->_init();
    }

    //模块控制器初始化
    protected function _init(){}

    /**
     * 转换数组的书籍分类名
     * @param $array
     * @return mixed
     */
    public function get_bookClass_name($array){
        $return = array();
        foreach($array as $key=>$val){
            $return[$key] = $val;
            $class = json_decode($val['class'],TRUE);
            $className = '';
            foreach($class as $k=>$v){
                $info = $this->bookClassService->selectBookClass($v);
                if($k == 0){
                    $className = $info['classname'];
                }else{
                    $className = $className.','.$info['classname'];
                }
            }
            $return[$key]['class'] = $className;
        }

        return $return;
    }

    /**
     * 将object对象转换为数组
     * @param object $array  object对象数组
     *
     * @return array
     */
    public function object_array($array)
    {
        if (is_object($array)) {
            $array = (array) $array;
        }
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $array[$key] = $this->object_array($value);
            }
        }
        return $array;
    }

}
