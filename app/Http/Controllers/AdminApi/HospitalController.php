<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/6/6
 * Time: 10:48
 */
namespace App\Http\Controllers\AdminApi;

use App\Libs\FcAdmin\Tool;
use App\Services\Admin\HospitalService;
use App\Services\DataTableService;
use App\Http\Controllers\AdminApi\BaseController;
use Illuminate\Http\Request;

class HospitalController extends BaseController
{

    //列表
    public function index(Request $request){
        $param = $request->all();

        $where= $param['sSearch'];
        $offset = $param['iDisplayStart'];
        $limit = $param['iDisplayLength'];
        $sortName = 'mDataProp_'.$param['iSortCol_0'];
        $orderName = $param[$sortName];
        $orderSort = $param['sSortDir_0'];
        $list['data'] = $this->hospitalService->selectHospital($where,$orderName,$orderSort,$offset,$limit,'sort','DESC');
        $list['iTotalDisplayRecords'] = $this->hospitalService->getHospitalCount($where);
        $list['iTotalRecords'] = $list['iTotalDisplayRecords'];
        $list['sEcho'] = $param['sEcho'];
        return response()->json($list);
    }

    //添加
    public function create(Request $request){
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建管理员
        $result = $this->hospitalService->createHospital($form_data);

        //返回响应
        return $this->tool->response($result, 'admin/hospitalInfo');

    }

    //修改
    public function update($id,Request $request){
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建管理员
        $result = $this->hospitalService->updateHospital($id,$form_data);

        //返回响应
        return $this->tool->response($result, 'admin/hospitalInfo');

    }

    //删除
    public function destroy($id)
    {
        $id = (int)$id;

        //删除管理员
        $result = $this->bookService->deleteBook($id);

        //返回响应
        return $this->tool->setType('json')->response($result);
    }

    /**
     * 将object对象转换为数组
     * @param object $array  object对象数组
     *
     * @return array
     */
    function object_array($array)
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