@extends('backend.master')
@section('title', 'Customers')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-8 ">
            <div class="card">
                <div class=" card-header justify-content-between ">
                    <div>
                        <h3 class="card-title">Registered Customers</h3>
                    </div>
                    <div>
                        <div class="d-inline">
                            <a class="btn btn-info" href="{{ route('customers.create') }}">Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Address</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <th>{{ $customer->id }}</th>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->mobile }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        @if ($customer->status == 0)
                                            <span class="badge bg-red">Inactive</span>
                                        @else
                                            <span class="badge bg-green">Active</span>
                                        @endif
                                    </td>
                                    <td style="width: 150px;">
                                        <div style="display: flex; gap: 2px;">
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                                                <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
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
                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
