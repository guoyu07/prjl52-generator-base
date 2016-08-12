@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>新增單位/處室</h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'backend.department.store', 'files' => true]) !!}

                        @include('backend.departments.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
