<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/6/7
 * Time: 16:11
 */
namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\AdminApi\BaseController;
use App\Libs\FcAdmin\Tool;
use App\Models\Admin\BookClass;
use App\Services\Admin\BookClassService;
use App\Services\Admin\BookService;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class BookClassController
{

    use DataTableService;

    private $tool;
    private $bookClassService;
    private $bookClass;

    public function __construct(BookClass $bookClass,Tool $tool, BookClassService $bookClassService)
    {
        //依赖注入model
        $this->bookClassService = $bookClassService;
        $this->bookClass = $bookClass;
        $this->tool = $tool;
    }

    //列表
    public function index(Request $request){
        $param = $request->all();

        //返回响应
        return $this->tool->response($this->bookClassService->dataTable(\App\Models\Admin\BookClass::class, ['id', 'classname', 'updated_at'], $param, [
            'condition' => [
                [
                    'where',
                    ['orWhere', 'classname like %?%']
                ]
            ]
        ]), true, 'json');
    }

    //添加
    public function create(Request $request){
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建书籍分类
        $result = $this->bookClassService->createBookClass($form_data);

        //返回响应
        return $this->tool->response($result, 'admin/bookClass');

    }

    //修改
    public function update($id,Request $request){
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建管理员
        $result = $this->bookClassService->updateBookClass($id,$form_data);

        //返回响应
        return $this->tool->response($result, 'admin/book');

    }

    //删除
    public function destroy($id)
    {
        $id = (int)$id;

        //删除管理员
        $result = $this->bookClassService->deleteBookClass($id);

        //返回响应
        return $this->tool->setType('json')->response($result);
    }


}