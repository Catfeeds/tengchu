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
use App\Models\Admin\Book;
use App\Models\Admin\BookClass;
use App\Models\Admin\Hospital;
use Illuminate\Support\Facades\Auth;
use App\Services\DataTableService;
use App\Services\FcAdminService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HospitalService extends FcAdminService
{
    use DataTableService;

    private $book;
    private $tool;
    private $bookClass;
    private $hospital;

    public function __construct(Hospital $hospital, Tool $tool,Book $book, BookClass $bookClass)
    {
        //依赖注入model
        $this->hospital = $hospital;
        $this->book = $book;
        $this->bookClass = $bookClass;

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
    public function selectHospital($where,$orderName,$orderSort,$offset,$limit,$secName,$secSort){

        if(!empty($where)){
            $search = explode('/',$where);
            $where1 = '%'.$search[0].'%';
            $where2 = '%'.$search[1].'%';
            $list = $this->hospital->where('name','like',$where1)->where('level','like',$where2)
                ->orderBy($secName,$secSort)
                ->orderBy($orderName,$orderSort)
                ->offset($offset)
                ->limit($limit)
                ->get()->toArray();
        }else{
            $list = $this->hospital->orderBy($secName,$secSort)
                ->orderBy($orderName,$orderSort)
                ->offset($offset)
                ->limit($limit)
                ->get()->toArray();
        }

        return $list;

    }

    /**
     * 获取医院信息
     */
    public function selectHospitalList($orderName,$orderSort){
        $list = $this->hospital->orderBy($orderName,$orderSort)->get()->toArray();
        return $list;
    }

    /**
     * 获取医院总数
     * @param $where  string  查询条件
     */
    public function getHospitalCount($where){
        if(!empty($where)){
            $search = explode('/',$where);
            $where1 = '%'.$search[0].'%';
            $where2 = '%'.$search[1].'%';
            $count = $this->hospital->where('name','like',$where1)->where('level','like',$where2)->count();

        }else{
            $count = $this->hospital->count();

        }
        return $count;
    }

    /**
     * 添加书籍
     * @param array $form_data
     * @return mixed
     */
    public function createHospital(array $form_data){

        foreach($form_data as $k=>$v){
            $this->hospital->$k = $v;
        }

        $id = $this->hospital->save();

        if(!$id) return $this->handleError('添加失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('创建了医院 [ ID:'.$id.', 名称:'.$this->hospital->name.']'));

        return $this->handleSuccess('添加成功!');
    }

    /**
     * 修改书籍
     * @param $id
     * @param array $form_data
     * @return mixed
     */
    public function updateHospital($id , array $form_data){
        $res = $this->hospital->where('id', $id)->update($form_data);
        if(!$res) return $this->handleError('编辑失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('修改了医院 [ ID:'.$id .', 名称:'.$form_data['name'].']'));

        return $this->handleSuccess('修改成功!');
    }

    /**
     * 删除书籍
     * @param $id
     * @return mixed
     */
    public function deleteBook($id)
    {
        $book = $this->book->find($id);
        //验证
        if(empty($book)){
            return $this->handleError('该书籍不存在!');
        }

        //删除
        //$res = $book -> delete();

        if($book->trashed()){
            //触发事件
            Event::fire(new AdminLoggerEvent('删除了书籍 [ ID:'.$id .', 书籍名:'.$book->name.']'));

            return $this->handleSuccess('删除成功!');
        }else{
            return $this->handleError('删除失败!');
        }
        //if(!$res) $this->handleError('删除失败!');
    }
}