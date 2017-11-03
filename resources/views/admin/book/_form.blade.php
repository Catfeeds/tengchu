{{ csrf_field() }}

<div class="form-group">
    <label for="description" class="col-md-3 control-label">产品名</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('name') ? $info->name : old('name') }}" placeholder="请输入书名">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">作者名</label>
    <div class="col-md-5">
        <input type="text" name="author" id="author" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('author') ? $info->author : old('author') }}" placeholder="请输入作者">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">发行商</label>
    <div class="col-md-5">
        <input type="text" name="publisher" id="publisher" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('URpublisherL') ? $info->publisher : old('publisher') }}" placeholder="请输入发行商">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">简介</label>
    <div class="col-md-5">
        <textarea class="form-control" id="intro" style="resize:vertical;" name="intro" rows="3" placeholder="请输入简洁">{{ $form_type == 'edit' && !old('intro') ? $info->intro : old('intro') }}</textarea>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">发行版本</label>
    <div class="col-md-5">
        <input type="text" name="version" id="version" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('version') ? $info->version : old('version') }}" placeholder="请输入发行版本">
    </div>
</div>

<div class="form-group">
    <label for="role" class="col-md-3 control-label">标签分类</label>
    <div class="col-md-5">
        <div>
            @foreach($bookClass_list as $k => $item)
                <input type="checkbox" class="minimal" name="class[]" @if($form_type == 'edit') @if(in_array($item['id'], $info->class)) checked="checked" @endif @else @if(in_array($item['id'], $class_ids)) checked="checked" @endif @endif value="{{$item['id']}}"> {{$item['classname']}} &nbsp;
            @endforeach
        </div>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">接口数据(书籍)</label>
    <div class="col-md-5">
        <textarea class="form-control" id="step" style="resize:vertical;" name="step" rows="3" placeholder="请输入接口数据">{{ $form_type == 'edit' && !old('step') ? $info->step : old('step') }}</textarea>
    </div>
</div>
<input type="hidden" name="type" value="0"/>