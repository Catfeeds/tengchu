@section('css')
    <link rel="stylesheet" href="{{ asset('static/admin/plugins/iCheck/all.css') }}">
@endsection
@section('js')
    <script src="{{ asset('static/admin/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {

            //上传组件
            fc_upload_img("#file_upload", { url: "{{url('adminApi/upload/image')}}", param: { type: 0 }, beforeUpload: function(){ loadShow() }, afterUpload: function(){ loadShow(0) }}, function(res){
                if(res.status <= 0){
                    fc_msg(res.msg, 0);
                    return;
                }
                //成功
                $("#docimg_val").val(res.data.img);
                $('#docimg_img').attr('src', res.data.img_url);
                $('#docimg_img').css("display", "block");
            });

            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        });
    </script>
@endsection
{{ csrf_field() }}


<div class="form-group">
    <label for="description" class="col-md-3 control-label">医生名字</label>
    <div class="col-md-5">
        <input type="text" name="docName" id="docName" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('docName') ? $info->docName : old('docName') }}" placeholder="请输入医生姓名">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">级别</label>
    <div class="col-md-5">
        <input type="text" name="level" id="level" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('level') ? $info->level : old('level') }}" placeholder="请输入级别">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">擅长</label>
    <div class="col-md-5">
        <input type="text" name="beGoodAt" id="beGoodAt" required="required" class="form-control" value="{{ $form_type == 'edit' && !old('beGoodAt') ? $info->beGoodAt : old('beGoodAt') }}" placeholder="请输入擅长">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">简介</label>
    <div class="col-md-5">
        <input class="form-control" id="deptIntro" name="description" required="required" value="{{ $form_type == 'edit' && !old('description') ? $info->description : old('description') }}" placeholder="请输入简介">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">部门介绍</label>
    <div class="col-md-5">
        <input class="form-control" id="deptName" name="deptName" required="required" value="{{ $form_type == 'edit' && !old('deptName') ? $info->deptName : old('deptName') }}" placeholder="请输入部门介绍">
    </div>
</div>


<div class="form-group">
    <label for="avatar" class="col-md-3 control-label">医生头像</label>
    <div class="col-md-5">
        <input type="hidden" name="docimg" id="docimg_val" value="{{$form_type == 'edit' && !old('docimg') ? '' : ( empty(old('docimg')) ? '' : old('docimg') ) }}" />
        <img id="docimg_img" src="{{ $form_type == 'edit' && !old('docimg') ? asset($info -> docimg) : (!empty(old('docimg')) ? asset(old('docimg')) : '') }}" class="img-lg img-circle" style="{{ $form_type == 'create' && empty(old('avatar')) ? 'display: none;' : '' }}float: none !important;">
    </div>
</div>
<div class="form-group">
    <label for="avatar" class="col-md-3 control-label">上传头像</label>
    <div class="col-md-5">
        <em class="btn bg-purple btn-sm fc-upload-btn"><input id="file_upload" name="Filedata" type="file" multiple="false" accept="image/gif,image/jpeg,image/jpg,image/png">选择头像</em>
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">专业</label>
    <div class="col-md-5">
        <input class="form-control" id="profession" name="profession" required="required" value="{{ $form_type == 'edit' && !old('profession') ? $info->profession : old('profession') }}" placeholder="请输入专业">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">最大挂号数</label>
    <div class="col-md-5">
        <input class="form-control" id="maxRegNum" name="maxRegNum" required="required" value="{{ $form_type == 'edit' && !old('maxRegNum') ? $info->maxRegNum : old('maxRegNum') }}" placeholder="请输入最大挂号数">
    </div>
</div>

<div class="form-group">
    <label for="description" class="col-md-3 control-label">排序</label>
    <div class="col-md-5">
        <input type="number" class="form-control" id="deptSort" name="deptSort" required="required" value="{{ $form_type == 'edit' && !old('deptSort') ? $info->deptSort : old('deptSort') }}" placeholder="请输入排序">
    </div>
</div>




