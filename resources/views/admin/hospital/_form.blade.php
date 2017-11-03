{{ csrf_field() }}

<div class="form-group">
    <label for="description" class="col-md-3 control-label">医院名称</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('name') ? $info->name : old('name') }}" placeholder="请输入名称">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">医院等级</label>
    <div class="col-md-5">
        <input type="text" name="level" id="level" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('level') ? $info->level : old('level') }}" placeholder="请输入等级">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">医院地址</label>
    <div class="col-md-5">
        <input type="text" name="address" id="address" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('address') ? $info->address : old('address') }}" placeholder="请输入地址">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">行政区域</label>
    <div class="col-md-5">
        <input class="form-control" id="division" name="division" required="required" value="{{ $form_type == 'edit' && !old('division') ? $info->division : old('division') }}" placeholder="请输入行政区域">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">医院开关</label>
    <div class="col-md-5">
            <select name="switch" id="switch">
            <option @if($info->switch == '1') selected @endif value="1">开</option>
            <option @if($info->switch == '0') selected @endif value="0">关</option>
        </select>
    </div>
</div>

@include('admin.ueditor.index')
