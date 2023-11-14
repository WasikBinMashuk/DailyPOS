@extends('backend.master')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-6 ">
            <form action="{{ route('suppliers.update', $editSupplier->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h2>Update Supplier</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col mb-3">
                                <label class="form-label required">Supplier Name</label>
                                <div>
                                    <input type="text" class="form-control" name="supplier_name"
                                        placeholder="Enter supplier name" value="{{ $editSupplier->supplier_name }}">
                                    @error('supplier_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label ">Email Address</label>
                                <div>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Enter email address" value="{{ $editSupplier->email }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Mobile</label>
                                <div>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror"
                                        name="mobile" placeholder="Enter mobile number"
                                        value="{{ $editSupplier->mobile }}">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Address</label>
                                <div>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" placeholder="Enter address" value="{{ $editSupplier->address }}">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
