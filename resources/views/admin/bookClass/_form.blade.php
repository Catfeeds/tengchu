{{ csrf_field() }}

<div class="form-group">
    <label for="description" class="col-md-3 control-label">分类名</label>
    <div class="col-md-5">
        <input type="text" name="classname" id="classname" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('classname') ? $info->classname : old('classname') }}" placeholder="请输入分类名">
    </div>
</div>
