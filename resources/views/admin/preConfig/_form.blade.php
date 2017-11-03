{{ csrf_field() }}

<div class="form-group">
    <label for="description" class="col-md-3 control-label">用户数据传输加密</label>
    <div class="col-md-5">
        <input type="text" name="encryptionvalue" id="encryptionvalue" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('encryptionvalue') ? $info->encryptionvalue : old('encryptionvalue') }}" placeholder="请输入加密信息">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">前置机web地址</label>
    <div class="col-md-5">
        <input type="text" name="apiurls" id="apiurls" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('apiurls') ? $info->apiurls : old('apiurls') }}" placeholder="请输入web地址">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">控制器</label>
    <div class="col-md-5">
        <input type="text" name="groups" id="groups" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('groups') ? $info->groups : old('groups') }}" placeholder="请输入控制器">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">方法</label>
    <div class="col-md-5">
        <input type="text" name="actions" id="actions" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('actions') ? $info->actions : old('actions') }}" placeholder="请输入方法">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">开关</label>
    <div class="col-md-5">
        <select name="switch" id="switch">
            <option @if($info->switch == '1') selected @endif value="1">开</option>
            <option @if($info->switch == '0') selected @endif value="0">关</option>
        </select>
    </div>
</div>


