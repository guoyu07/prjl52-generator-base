@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>編輯單位/處室</h1>
    </section>
    <div class="content">
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                {!! Form::model($department, ['route' => ['backend.department.update', $department->id], 'method' => 'put', 'files' => true]) !!}

                @include('backend.departments.fields')

                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection