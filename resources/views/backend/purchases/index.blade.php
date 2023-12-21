@extends('backend.master')
@section('title', 'Purchase history')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div>
                            <h3 class="card-title">Purchse History ({{ $purchases->total() }})</h3>
                        </div>
                        <div>

                            <div class="d-inline">
                                <a class="btn btn-info" href="{{ route('purchases.create') }}">Add</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Category ID</th> --}}
                                    <th scope="col">Purchase ID</th>
                                    <th scope="col">Supplier Name</th>
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">Purchase Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{ $purchase->supplier->supplier_name }}</td>
                                        <td>{{ $purchase->branch->branch_name }}</td>
                                        <td>{{ $purchase->date }}</td>
                                        <td>
                                            @if ($purchase->status == 'received')
                                                <span class="badge bg-success">Received</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $purchase->payment_method }}</td>
                                        <td>{{ $purchase->subtotal }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Purchase Actions">
                                                <a href="{{ route('purchases.edit', $purchase->id) }}"
                                                    class="btn btn-primary">
                                                    <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                                </a>
                                                <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-info">
                                                    <i class="fa-regular fa-eye" style="color: #ffffff;"></i>
                                                </a>
                                                {{-- <form action="{{ route('purchases.destroy', $purchase->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure to delete this user?')">
                                                        <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $purchases->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
