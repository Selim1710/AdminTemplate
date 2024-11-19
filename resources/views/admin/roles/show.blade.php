@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permission Manage</a></li>
                        <li class="breadcrumb-item active">Show Role!</li>
                    </ol>
                </div>
                <h4 class="page-title">Show Role!</h4>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="d-flex">
            <a class="btn btn-success" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card">
                <h4 class="card-header"> Role :  &nbsp; {{ $role->name }} </h4>
            </div>
        </div>

        <!-- permission -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="card-title">
                        <h3> Permission </h3>
                    </div>
                    <hr>
                    <div class="row">
                        @if (!empty($rolePermissions))
                            @foreach ($rolePermissions as $permission)
                                @php
                                    $permission_name = str_replace('-', ' ', $permission->name);
                                @endphp
                                <div class="col-xs-6 col-sm-6 col-md-2">
                                    <h4 class="text-capitalize btn btn-light rounded btn-md w-100">
                                        {{ $permission_name }}
                                    </h4>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
