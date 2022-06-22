@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">User</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card border border-primary">
            <div class="card-header bg-transparent border-primary d-flex justify-content-between">
                <h5 class="my-0 text-primary align-middle"><i class="mdi mdi-bullseye-arrow me-3"></i> Create coupon </h5>
                <a href="{{ route('coupon.index') }}" class="btn btn-sm btn-primary waves-effect waves-light">
                    <i class="bx bx-list-plus font-size-20 align-middle me-2"></i> All coupons
                </a>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                <script>
                    swal({
                        title: 'success!',
                        text: "{{ Session::get('success')}}",
                        icon = 'success',
                        timer: 5000
                    });

                </script>
                @endif

                @if (Session::has('error'))
                <script>
                    swal({
                        title: 'error!'
                        text: "{{ Session::get('error')}}",
                        icon = 'error',
                        timer: 5000
                    });

                </script>
                @endif
                <form method="POST" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 my-2">
                            <div class="form-group" {{$errors->has('coupon_title') ? ' has-error':''}}>
                                <div class="mb-3">
                                    <label class="form-label"><strong class="text-primary">coupon Title<span
                                                class="text-danger">*</span>:</strong></label>
                                    <input type="text" class="form-control" name="coupon_title" value="{{ old('coupon_title') }}">
                                </div>
                                @if ($errors->has('coupon_title'))
                                <span class="error text-danger">{{ $errors->first('coupon_title') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-group" {{$errors->has('coupon_code') ? ' has-error':''}}>
                                <div class="mb-3">
                                    <label class="form-label"><strong class="text-primary">coupon Code<span
                                                class="text-danger">*</span>:</strong></label>
                                    <input type="text" class="form-control" name="coupon_code" value="{{ old('coupon_code') }}">
                                </div>
                                @if ($errors->has('coupon_code'))
                                <span class="error text-danger">{{ $errors->first('coupon_code') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-group" {{$errors->has('coupon_starting') ? ' has-error':''}}>
                                <div class="mb-3">
                                    <label class="form-label"><strong class="text-primary">coupon starting<span
                                                class="text-danger">*</span>:</strong></label>
                                    <input type="date" class="form-control" name="coupon_starting" value="{{ old('coupon_starting') }}">
                                </div>
                                @if ($errors->has('coupon_starting'))
                                <span class="error text-danger">{{ $errors->first('coupon_starting') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 my-2">
                            <div class="form-group" {{$errors->has('coupon_ending') ? ' has-error':''}}>
                                <div class="mb-3">
                                    <label class="form-label"><strong class="text-primary">coupon Ending<span
                                                class="text-danger">*</span>:</strong></label>
                                    <input type="date" class="form-control" name="coupon_ending" value="{{ old('coupon_ending') }}">
                                </div>
                                @if ($errors->has('coupon_ending'))
                                <span class="error text-danger">{{ $errors->first('coupon_ending') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 my-2">
                            <div class="form-group" {{$errors->has('coupon_remarks') ? ' has-error':''}}>
                                <div class="mb-3">
                                    <label class="form-label"><strong class="text-primary">coupon Remarks:</strong></label>
                                    <textarea type="text" class="form-control" name="coupon_remarks" value="{{ old('coupon_remarks') }}"></textarea>
                                </div>
                                @if ($errors->has('coupon_remarks'))
                                <span class="error text-danger">{{ $errors->first('coupon_remarks') }}</span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-md">Update</button>
                            </div>
                </form>
            </div>
        </div>
        <!-- end cardaa -->
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection

