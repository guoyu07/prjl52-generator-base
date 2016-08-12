<!-- Name Field -->
<div class="form-group col-sm-8">
    {!! Form::label('name', '名稱:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('儲存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.department.index') !!}" class="btn btn-default">取消</a>
</div>
