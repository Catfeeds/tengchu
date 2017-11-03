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
use App\Models\Admin\WechatConfig;
use App\Services\Admin\WechatConfigService;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class WechatConfigController{

    use DataTableService;

    private $wechatConfig;
    private $tool;
    private $wechatConfigService;

    public function __construct(WechatConfig $wechatConfig,Tool $tool,WechatConfigService $wechatConfigService)
    {
        //依赖注入model
        $this->wechatConfig = $wechatConfig;
        $this->wechatConfigService = $wechatConfigService;
        $this->tool = $tool;
    }

    //列表
    public function index(Request $request){
        $param = $request->all();
        //返回响应
        return $this->tool->response($this->wechatConfigService->dataTable(\App\Models\Admin\WechatConfig::class, ['id', 'AppID', 'Token', 'EncodingAESKey','merchant', 'updated_at'], $param, [
            'condition' => [
                [
                    'where',
                    ['orWhere', 'AppID like %?%']
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
        $result = $this->wechatConfigService->updateWechat($id,$form_data);

        //返回响应
        return $this->tool->response($result, 'admin/wechatConfig');

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