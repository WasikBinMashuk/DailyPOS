@extends('backend.master')
@section('title', 'Sell history')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div>
                            <h3 class="card-title">Sell History ({{ $sells->total() }})</h3>
                        </div>
                        <div>

                            <div class="d-inline">
                                {{-- <a class="btn btn-info" href="{{ route('sells.create') }}">Add</a> --}}
                                {{-- Branch --}}
                                <span class="badge bg-light text-dark fw-semibold fs-4">{{ $branch->branch_name }}
                                    Branch</span>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Category ID</th> --}}
                                    <th scope="col">Sell ID</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Due</th>
                                    <th scope="col">Paid</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sells as $sell)
                                    <tr>
                                        <td>{{ $sell->id }}</td>
                                        <td>{{ $sell->customer_id }}</td>
                                        <td>{{ $sell->customer->name }}</td>
                                        <td>{{ $sell->sellPayment->payment_method }}</td>
                                        <td>{{ $sell->sellPayment->due }}</td>
                                        <td>{{ $sell->sellPayment->paid }}</td>
                                        <td>{{ $sell->subtotal }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Purchase Actions">
                                                {{-- <a href="{{ route('sells.edit', $sell->id) }}" class="btn btn-primary">
                                                    <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                                </a> --}}
                                                <a href="{{ route('sells.show', $sell->id) }}" class="btn btn-info">
                                                    <i class="fa-regular fa-eye" style="color: #ffffff;"></i>
                                                </a>
                                                {{-- <form action="{{ route('sells.destroy', $sell->id) }}"
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

                        {{ $sells->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
