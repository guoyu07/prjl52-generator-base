<!-- Department Field -->
<div class="form-group col-sm-6">
    {!! Form::label('department_id', '發佈單位/處室:') !!}
    {!! Form::select('department_id', $departments, null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-8">
    {!! Form::label('title', '標題:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', '內容:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

@if(isset($news) && count($news->attachments))
<!-- Uploaded Attachment Field -->
<div class="form-inline col-sm-12 col-lg-8" style="margin-bottom:15px">
	{!! Form::label('uploaded', '已上傳附件:') !!}
	@foreach($news->attachments as $attachment)
	<div>
		{{$attachment->name}}@if($attachment->extension).{{$attachment->extension}}@endif
		<a href="{{route('backend.attachment.destroy', [$news->id, $attachment->id])}}" class="delete"><i class="glyphicon glyphicon-minus"></i> [刪除附件]</a>
	</div>
	@endforeach
</div>
@endif

<!-- Attachment Field -->
<div class="form-group col-sm-12 col-lg-8">
    {!! Form::label('attachments[]', '附件:') !!}
    <div class="append-area">
    	<input class="form-control" name="attachments[]" type="file" id="attachments">
    </div>
    <a href="#" class="add-file"><i class="glyphicon glyphicon-plus"></i> [增加附件]</a>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('儲存', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.news.index') !!}" class="btn btn-default">取消</a>
</div>
