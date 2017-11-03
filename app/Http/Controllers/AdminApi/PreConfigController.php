<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/24
 * Time: 9:40
 */
namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\AdminApi\BaseController;
use App\Libs\FcAdmin\Tool;
use App\Models\Admin\PreConfig;
use App\Services\Admin\PreConfigService;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class PreConfigController{

    use DataTableService;

    private $preConfig;
    private $tool;
    private $preConfigService;

    public function __construct(PreConfig $preConfig,Tool $tool,PreConfigService $preConfigService)
    {
        //依赖注入model
        $this->preConfig = $preConfig;
        $this->preConfigService = $preConfigService;
        $this->tool = $tool;
    }

    //列表
    public function index(Request $request){
        $param = $request->all();
        //返回响应
        return $request = $this->tool->response($this->preConfigService->dataTable(\App\Models\Admin\PreConfig::class, ['*'], $param, [
            'condition' => [
                [
                    'where',
                    //['orWhere', 'AppID like %?%']
                ]
            ]
        ]), true, 'json');
    }

    //添加
    public function create(Request $request){
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建管理员
        $result = $this->wechatConfigService->createWechat($form_data);

        //返回响应
        return $this->tool->response($result, 'admin/wechatConfig');

    }

    //修改
    public function update($id,Request $request){
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建管理员
        $result = $this->preConfigService->updatePre($id,$form_data);

        //返回响应
        return $this->tool->response($result, 'admin/preConfig');

    }

    //删除
    public function destroy($id)
    {
        $id = (int)$id;

        //删除管理员
        $result = $this->wechatConfigService->deleteWechat($id);

        //返回响应
        return $this->tool->setType('json')->response($result);
    }

}