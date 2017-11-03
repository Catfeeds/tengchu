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
use App\Models\Admin\doctor;
use Illuminate\Support\Facades\Auth;
use App\Services\DataTableService;
use App\Services\FcAdminService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Query\Builder;

class DoctorService extends FcAdminService
{
    use DataTableService;

    private $tool;
    private $doctor;

    public function __construct(Tool $tool, doctor $doctor)
    {
        //依赖注入model

        $this->doctor = $doctor;

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
     * 获取医生列表
     */
    public function selectDoctor($where,$orderName,$orderSort,$offset,$limit,$secName,$secSort){
        $search = explode('/',$where);
        $list = $this->doctor
            ->leftJoin('department', 'department.id', '=', 'doctor.deptHisId')
            ->leftJoin('hospital', 'department.hos_id', '=', 'hospital.id')
            ->where(function ($query) use ($search) {
                if (!empty($search[0])) {
                    $query->where('docName', 'like', '%' . $search[0] . '%');
                }
            })
            ->where(function ($query) use ($search) {
                if (!empty($search[1])) {
                    $query->where('deptName', 'like', '%' . $search[1] . '%');
                }
            })
            ->where(function ($query) use ($search) {
                if (!empty($search[2])) {
                    $query->where('hos_id', '=', $search[2]);
                }
            })
            ->orderBy('doctor.' . $secName, $secSort)->orderBy('doctor.' . $orderName, $orderSort)->offset($offset)->limit($limit)
            ->select('doctor.*', 'department.deptName','department.hos_id', 'hospital.name')
            ->get()->toArray();

        return $list;
    }

    /**
     * 获取医生总数
     * @param $where  string  查询条件
     */
    public function getDoctorCount($where){
        $search = explode('/',$where);
        $count = $this->doctor
            ->leftJoin('department', 'department.id', '=', 'doctor.deptHisId')
            ->leftJoin('hospital', 'department.hos_id', '=', 'hospital.id')
            ->where(function ($query) use ($search) {
                if (!empty($search[0])) {
                    $query->where('docName', 'like', '%' . $search[0] . '%');
                }
            })
            ->where(function ($query) use ($search) {
                if (!empty($search[1])) {
                    $query->where('deptName', 'like', '%' . $search[1] . '%');
                }
            })
            ->where(function ($query) use ($search) {
                if (!empty($search[1])) {
                    $query->where('hos_id', '=', $search[2]);
                }
            })
            ->count();
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
    public function updateDoctor($id , array $form_data){

        //头像
        if(empty($form_data['docimg'])){
            unset($form_data['docimg']);
        } else {
            //移动临时头像文件
            $date = date('Ymd');
            $new_path = 'upload/admin/docimg/'.$date;
            $new_file = moveFile($form_data['docimg'], $new_path);
            if($new_file) $form_data['docimg'] = $new_file;
        }

        $res = $this->doctor->where('id', $id)->update($form_data);

        if($res>1) return $this->handleError('编辑失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('修改了医生'));

        //修改成功
        return $this->handleSuccess('编辑成功!');
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