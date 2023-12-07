@extends('backend.master')
@section('title', 'Edit branch')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-6 ">
            <form action="{{ route('branches.update', $editBranch->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h2>Update Branch</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col mb-3">
                                <label class="form-label required">Branch Name</label>
                                <div>
                                    <input type="text" class="form-control" name="branch_name"
                                        placeholder="Enter branch name" value="{{ $editBranch->branch_name }}">
                                    @error('branch_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Mobile</label>
                                <div>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                        name="mobile" placeholder="Enter mobile number" value="{{ $editBranch->mobile }}">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Address</label>
                                <div>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" placeholder="Enter address" value="{{ $editBranch->address }}">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Make Default</label>
                                <div>
                                    <select name="default" class="form-select">
                                        <option value="1" {{ $editBranch->default == '1' ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ $editBranch->default == '0' ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
