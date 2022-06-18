@extends('layouts.admin')
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Banners</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Banner</a></li>
                    <li class="breadcrumb-item active">Create Banner</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card border border-primary">
            <div class="card-header bg-transparent border-primary d-flex justify-content-between">
                <h5 class="my-0 text-primary align-middle"><i class="mdi mdi-bullseye-arrow me-3"></i>Banners Information</h5>
                <a href="{{ route('banner.index') }}" class="btn btn-sm btn-primary waves-effect waves-light">
                    <i class="bx bx-list-plus font-size-20 align-middle me-2"></i> All Banner
                </a>
            </div>
            <div class="card-body">
                <div class="p-4 border rounded">
                    <div class="table-responsive">
                        <table class="table mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>Iteam</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Title :</th>
                                    <td>{{ $data['banner_title'] }}</td>
                                </tr>
                                <tr>
                                    <th>MidTitle :</th>
                                    <td>{{ $data['banner_mid_title'] }}</td>
                                </tr>
                                <tr>
                                    <th>SubTitle :</th>
                                    <td>{{ $data['banner_subtitle'] }}</td>
                                </tr>
                                <tr>
                                    <th>Button Title :</th>
                                    <td>{{ $data['banner_button'] }}</td>
                                </tr>
                                <tr>
                                    <th>Image :</th>
                                    <td>
                                        @if ($data -> banner_image != '')
                                            <img src="{{ asset('uploads/banner/' . $data->banner_image) }}" height="60">
                                            @else
                                            <img src="{{ asset('uploads/no_image.png') }}" height="60">
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status :</th>
                                    <td>
                                        @if ($data->banner_status == 1)
                                        <div class="badge badge-soft-success font-size-12">Active</div>
                                        @else
                                        <div class="badge badge-soft-danger font-size-12">Disabled</div>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
