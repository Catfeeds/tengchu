<?php
/**
 * Created by PhpStorm.
 * User: yx
 * Date: 2017/5/26
 * Time: 15:44
 */

namespace App\Services\Admin;

use App\Events\AdminLoggerEvent;
use App\Libs\FcAdmin\Tool;
use App\Models\Admin\WechatConfig;
use Illuminate\Support\Facades\Auth;
use App\Services\DataTableService;
use App\Services\FcAdminService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;

class WechatConfigService extends FcAdminService
{
    use DataTableService;

    private $wechatConfig;
    private $tool;

    public function __construct(WechatConfig $wechatConfig,Tool $tool)
    {
        //依赖注入model
        $this->wechatConfig = $wechatConfig;

        //依赖注入工具类
        $this->tool = $tool;
    }

    /**
     * 添加公众号
     * @param array $form_data
     * @return mixed
     */
    public function createWechat(array $form_data){
        foreach($form_data as $k=>$v){
            $this->wechatConfig->$k = $v;
        }

        $id = $this->wechatConfig->save();

        if(!$id) return $this->handleError('添加失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('创建了微信应用 [ ID:'.$id.', AppID:'.$this->wechatConfig->AppID.']'));

        return $this->handleSuccess('添加成功!');
    }

    /**
     * 修改公众号
     * @param $id
     * @param array $form_data
     * @return mixed
     */
    public function updateWechat($id , array $form_data){
        $res = $this->wechatConfig->where('id', $id)->update($form_data);
        if(!$res) return $this->handleError('编辑失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('修改了微信应用 [ ID:'.$id .', AppID:'.$form_data['AppID'].']'));

        return $this->handleSuccess('添加成功!');
    }

    /**
     * 删除公众号
     * @param $id
     * @return mixed
     */
    public function deleteWechat($id)
    {
        $wechat = $this->wechatConfig->find($id);
        //验证
        if(empty($wechat)){
            return $this->handleError('该公众号不存在!');
        }

        //头像
        $res = $wechat -> delete();
        if(!$res) $this->handleError('删除失败!');

        //触发事件
        Event::fire(new AdminLoggerEvent('删除了微信应用 [ ID:'.$id .', AppID:'.$wechat->AppID.']'));

        return $this->handleSuccess('删除成功!');
    }

}