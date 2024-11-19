@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">ETL</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permission Manage</a></li>
                        <li class="breadcrumb-item active">Edit Role!</li>
                    </ol>
                </div>
                <h4 class="page-title">Edit Role!</h4>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="d-flex justify-content-end">
            @can('role-create')
                <a class="btn btn-success" href="{{ route('roles.index') }}">Back</a>
            @endcan
        </div>
    </div>
    <br>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h4> <label>Role Name:</label> </h4>
                {!! Form::text('name', null, ['placeholder' => 'Enter Role Name', 'class' => 'form-control']) !!}
            </div>
        </div>

        <!-- permission -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="card-title">
                        <h4><strong class="text-capitalize">permission</strong></h4>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach ($permission as $value)
                            <div class="col-xs-6 col-sm-6 col-md-3">
                                <label>
                                    <h4 class="text-gg">
                                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                        {{ $value->name }}
                                    </h4>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- submit btn -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card mt-2">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
