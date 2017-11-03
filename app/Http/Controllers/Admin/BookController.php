<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/31
 * Time: 15:17
 */
namespace App\Http\Controllers\Admin;

use App\Models\Admin\Book;
use App\Models\Admin\BookClass;
use App\Services\Admin\BookService;
use Illuminate\Support\Facades\DB;


class BookController extends BaseController{


    //列表
    public function index(){
        return view('admin.book.index');
    }

    //新增
    public function create(){
        $bookClass = new BookClass();
        $bookClass_list = $bookClass->get();
        $class_ids = array();

        return view('admin.book.create', compact('bookClass_list','class_ids'));
    }

    //修改
    public function edit($id){
        $id = (int)$id;

        $model = new Book();
        $info = $model->find($id);
        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该书籍不存在!'], 'admin/book');

        //书籍分类
        $bookClass = new BookClass();
        $bookClass_list = $bookClass->get();
        $class_ids = array();

        return view('admin.book.edit', compact('info','bookClass_list','class_ids'));
    }

    //详情
    public function show($id){
        $model = new Book();
        $info = $model->find($id);

        //验证
        if(empty($info)) return $this->tool->response(['status' => 0, 'msg' => '该书籍不存在!'], 'admin/book');

        return view('admin.book.show', compact('info'));
    }
}