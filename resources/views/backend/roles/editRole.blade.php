@extends('backend.master')
@section('title', 'Edit customer')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-5 ">
            <form action="{{ route('roles.update', $editRole->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h2>Update Role</h2>
                    </div>
                    <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label required">Role Name</label>
                                <div>
                                    <input type="text" class="form-control" name="name" placeholder="Enter name"
                                        value="{{ $editRole->name }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
