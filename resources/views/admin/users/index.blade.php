@extends('admin.app')
@section('admin_content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permission Manage</a></li>
                        <li class="breadcrumb-item active">Users Management!</li>
                    </ol>
                </div>
                <h4 class="page-title">Users Management!</h4>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @include('admin.pages.validation_error_message')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
        </div>
        <br>
        <div class="card-body">
            <table id="basic-datatable" class="table table-bordered table-striped dt-responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $data)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                @if (!empty($data->getRoleNames()))
                                    @foreach ($data->getRoleNames() as $role_name)
                                        <h5 class="">{{ $role_name }}</h5>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                {{-- @can('user-list')
                                <a class="btn btn-info btn-sm" href="{{ route('users.show', $data->id) }}">Show</a>
                            @endcan --}}

                                @can('user-edit')
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $data->id) }}">Edit</a>
                                @endcan

                                @can('user-delete')
                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#danger-header-modal{{ $data->id }}">
                                        Delete
                                    </a>
                                @endcan
                            </td>

                        </tr>

                        <!--------------------- Delete Modal ----------------------------->
                        <div id="danger-header-modal{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="danger-header-modalLabel{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h4 class="modal-title" id="danger-header-modalLabe{{ $data->id }}l">Delete
                                            user </h4>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('users.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
