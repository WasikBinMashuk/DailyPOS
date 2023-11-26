@extends('backend.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div>
                            <h3 class="card-title">Suppliers</h3>
                        </div>
                        <div>

                            <div class="d-inline">
                                <a class="btn btn-info" href="{{ route('suppliers.create') }}">Add</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Category ID</th> --}}
                                    <th scope="col">Supplier Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Actions</th>
                                    {{-- <th scope="col"></th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->mobile }}</td>
                                        <td>{{ $supplier->address }}</td>

                                        <td style="width: 150px;">
                                            <div style="display: flex; gap: 2px;">
                                                <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                                </a>
                                                <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger form-delete-sweetAlert">
                                                        <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $suppliers->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
