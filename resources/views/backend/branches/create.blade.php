@extends('backend.master')
@section('title', 'Create branch')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-4 ">
            <form action="{{ route('branches.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add New Branch</h3>
                    </div>
                    <div class=" card-body  ">
                        <div class=" mb-3">
                            <label class="form-label required">Branch Name</label>
                            <div>
                                <input type="text" class="form-control @error('branch_name') is-invalid @enderror"
                                    name="branch_name" placeholder="Enter branch name" value="{{ old('branch_name') }}">
                                @error('branch_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label class="form-label required">Mobile</label>
                            <div>
                                <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                    name="mobile" placeholder="Enter mobile number" value="{{ old('mobile') }}">
                                @error('mobile')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label class="form-label">Address</label>
                            <div>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" placeholder="Enter address" value="{{ old('address') }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
