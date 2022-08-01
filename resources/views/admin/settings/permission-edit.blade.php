@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Role</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Role Permission</a></li>
                    <li class="breadcrumb-item active">Edit Role Permission</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card border border-primary">
            <div class="card-header bg-transparent border-primary d-flex justify-content-between">
                <h5 class="my-0 text-primary align-middle"><i class="mdi mdi-bullseye-arrow me-3"></i>Update Role Permission for <span class="text-primary">{{ $role->name }}</span></h5>
                <a href="{{ route('permission') }}" class="btn btn-sm btn-primary waves-effect waves-light">
                    <i class="bx bx-list-plus font-size-20 align-middle me-2"></i> All Role Permission</a>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('permission.update',['role_id'=> $role->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row form-group">
                            @foreach ($permissions as $k => $permission)
                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    <input {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}} value="{{ $permission->name }}" name="permission[]" type="checkbox" class="form-check-input" id="{{ str()->slug($permission->name, '-').$k }}">
                                    <label class="form-check-label text-capitalize" for="{{ str()->slug($permission->name, '-').$k }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach


                            <div class="col-md-2 mt-4">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <i class="bx bxs-save font-size-16 align-middle me-2"></i> User Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
