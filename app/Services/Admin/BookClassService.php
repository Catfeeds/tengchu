<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/6/7
 * Time: 15:54
 */
namespace App\Services\Admin;

use App\Events\AdminLoggerEvent;
use App\Libs\FcAdmin\Tool;
use App\Models\Admin\BookClass;
use Illuminate\Support\Facades\Auth;
use App\Services\DataTableService;
use App\Services\FcAdminService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class BookClassService extends FcAdminService
{
    use DataTableService;

    private $tool;
    private $bookClass;

    public function __construct(Tool $tool, BookClass $bookClass)
    {
        //依赖注入model
        $this->bookClass = $bookClass;

        //依赖注入工具类
        $this->tool = $tool;
    }

    /**
     * 根据ID获取书籍分类信息
     * @param $id
     * @return mixed
     */
    public function selectBookClass($id){
        $info = $this->bookClass->find($id)->toArray();

        return $info;
    }


    /**
     * 添加书籍分类
     * @param array $form_data
     * @return mixed
     */
    public function createBookClass(array $form_data){
        foreach($form_data as $k=>$v){
            $this->bookClass->$k = $v;
        }

        $id = $this->bookClass->save();

        if(!$id) return $this->handleError('添加失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('创建了书籍 [ ID:'.$id.', 书籍分类名:'.$this->bookClass->classname.']'));

        return $this->handleSuccess('添加成功!');
    }

    /**
     * 修改书籍分类
     * @param $id
     * @param array $form_data
     * @return mixed
     */
    public function updateBookClass($id , array $form_data){
        $res = $this->bookClass->where('id', $id)->update($form_data);
        if(!$res) return $this->handleError('编辑失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('修改了书籍分类 [ ID:'.$id .', 书籍名:'.$form_data['classname'].']'));

        return $this->handleSuccess('添加成功!');
    }

    /**
     * 删除书籍分类
     * @param $id
     * @return mixed
     */
    public function deleteBookClass($id)
    {
        $bookClass = $this->bookClass->find($id);
        //验证
        if(empty($bookClass)){
            return $this->handleError('该书籍分类不存在!');
        }

        //头像
        $res = $bookClass -> delete();
        if(!$res) $this->handleError('删除失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('删除了书籍分类 [ ID:'.$id .', 书籍分类名:'.$bookClass->classname.']'));

        return $this->handleSuccess('删除成功!');
    }
}