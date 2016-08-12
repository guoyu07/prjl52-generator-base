@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>發佈公告</h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.news.store', 'files' => true]) !!}

                        @include('backend.news.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.10/standard/ckeditor.js"></script>
<script>
    $(".add-file").click(function(e) {
        e.preventDefault();
        $(".append-area").append($("#attachments").clone());
    });

    $(function () {
        CKEDITOR.replace('content', {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
    });
</script>
@endsection