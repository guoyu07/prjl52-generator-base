@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="page-header">公告列表</h1>
        <div class="pull-left">
           <a class="btn btn-info pull-right" style="margin-bottom: 10px" href="{!! route('backend.news.create') !!}"><i class="fa fa-plus-circle fa-fw"></i> 發佈公告</a>
        </div>

        <!-- Search Area -->
        {!! Form::open(['route' => ['backend.news.index'], 'method' => 'get', 'class' => 'form-inline pull-right']) !!}
        <!-- Department Field -->
        <div class="form-group">
            {!! Form::label('department_id', '發佈單位/處室:') !!}
            {!! Form::select('department_id', $departments, request('department_id'), ['class' => 'form-control']) !!}
        </div>
        &nbsp;
        <!-- Search Field-->
        <div class="form-group">
            {!! Form::label('search', '搜尋:') !!}
            {!! Form::text('search', request('search'), ['class' => 'form-control', 'placeholder' => '請輸入標題']) !!}
        </div>
        {!! Form::button('<i class="glyphicon glyphicon-search"></i> 查詢', ['type' => 'submit', 'class' => 'btn btn-warning']) !!}
        {!! Form::close() !!}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @if(count($news))
                @include('backend.news.table')
                @else
                <h4><i class="glyphicon glyphicon-warning-sign"></i> 目前尚無任何資料</h4>
                @endif
            </div>
        </div>
    </div>

    <div style="text-align:center">
        {!! $news->appends(Input::except('page'))->render() !!}
    </div>
@endsection

