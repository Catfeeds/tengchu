<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/6/6
 * Time: 10:49
 */
namespace App\Services\Admin;

use App\Events\AdminLoggerEvent;
use App\Libs\FcAdmin\Tool;
use App\Models\Admin\Department;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\Auth;
use App\Services\DataTableService;
use App\Services\FcAdminService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;

class OrderService extends FcAdminService
{
    use DataTableService;

    private $tool;
    private $order;

    public function __construct(Tool $tool, order $order)
    {
        //依赖注入model

        $this->order = $order;

        //依赖注入工具类
        $this->tool = $tool;
    }


    /**
     * @param $where
     * @param $orderName
     * @param $orderSort
     * @param $offset
     * @param $limit
     * @return mixed
     * 获取医院列表
     */
    public function selectOrder($where,$orderName,$orderSort,$offset,$limit){
        $list = $this->order->where('out_trade_no','like',$where)->orderBy($orderName,$orderSort)->offset($offset)->limit($limit)->get()->toArray();

        return $list;
    }

    /**
     * 获取医院总数
     * @param $where  string  查询条件
     */
    public function getOrderCount($where){
        $count = $this->order->where('out_trade_no','like',$where)->count();

        return $count;
    }

    /**
     * 添加书籍
     * @param array $form_data
     * @return mixed
     */
    public function createDepartment(array $form_data){

        foreach($form_data as $k=>$v){
            $this->department->$k = $v;
        }

        $id = $this->department->save();

        if(!$id) return $this->handleError('添加失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('创建了科室 [ ID:'.$id.', 名称:'.$this->department->deptName.']'));

        return $this->handleSuccess('添加成功!');
    }

    /**
     * 修改科室
     * @param $id
     * @param array $form_data
     * @return mixed
     */
    public function updateDepartment($id , array $form_data){

        $res = $this->department->where('id', $id)->update($form_data);
        if(!$res) return $this->handleError('编辑失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('修改了科室 [ ID:'.$id .', 名称:'.$form_data['deptName'].']'));

        return $this->handleSuccess('修改成功!');
    }

    /**
     * 删除科室
     * @param $id
     * @return mixed
     */
    public function deleteDepartment($id)
    {
        $department = $this->department->find($id);
        //验证
        if(empty($department)){
            return $this->handleError('该科室不存在!');
        }

        //删除
        $res = $department -> delete();

        if($res != false){
            //触发事件
            Event::fire(new AdminLoggerEvent('删除了科室 [ ID:'.$id .', 科室名:'.$department->deptName.']'));

            return $this->handleSuccess('删除成功!');
        }else{
            return $this->handleError('删除失败!');
        }
        //if(!$res) $this->handleError('删除失败!');
    }
}