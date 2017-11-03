{{ csrf_field() }}

<div class="form-group">
    <label for="description" class="col-md-3 control-label">部门名称</label>
    <div class="col-md-5">
        <input type="text" name="deptName" id="deptName" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('deptName') ? $info->deptName : old('deptName') }}" placeholder="请输入部门名称">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">院区</label>
    <div class="col-md-5">
        <input type="text" name="districtId" id="districtId" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('districtId') ? $info->districtId : old('districtId') }}" placeholder="请输入院区">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">科室介绍</label>
    <div class="col-md-5">
        <input class="form-control" id="deptIntro" name="deptIntro" required="required" value="{{ $form_type == 'edit' && !old('deptIntro') ? $info->deptIntro : old('deptIntro') }}" placeholder="请输入科室介绍">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">科室介绍url</label>
    <div class="col-md-5">
        <input class="form-control" id="deptIntroUrl" name="deptIntroUrl" required="required" value="{{ $form_type == 'edit' && !old('deptIntroUrl') ? $info->deptIntroUrl : old('deptIntroUrl') }}" placeholder="请输入科室介绍url">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">科室地址</label>
    <div class="col-md-5">
        <input class="form-control" id="deptAddress" name="deptAddress" required="required" value="{{ $form_type == 'edit' && !old('deptAddress') ? $info->deptAddress : old('deptAddress') }}" placeholder="请输入科室地址">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">科室经纬度</label>
    <div class="col-md-5">
        <input class="form-control" id="deptPosition" name="deptPosition" required="required" value="{{ $form_type == 'edit' && !old('deptPosition') ? $info->deptPosition : old('deptPosition') }}" placeholder="请输入科室经纬度">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">科室电话</label>
    <div class="col-md-5">
        <input class="form-control" id="deptTel" name="deptTel" required="required" value="{{ $form_type == 'edit' && !old('deptTel') ? $info->deptTel : old('deptTel') }}" placeholder="请输入科室电话">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">HIS科室名称</label>
    <div class="col-md-5">
        <input class="form-control" id="deptHisName" name="deptHisName" required="required" value="{{ $form_type == 'edit' && !old('deptHisName') ? $info->deptHisName : old('deptHisName') }}" placeholder="请输入科室电话">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">排序</label>
    <div class="col-md-5">
        <input type="number" class="form-control" id="deptSort" name="deptSort" required="required" value="{{ $form_type == 'edit' && !old('deptSort') ? $info->deptSort : old('deptSort') }}" placeholder="请输入排序">
    </div>
</div>

@include('admin.ueditor.index')


