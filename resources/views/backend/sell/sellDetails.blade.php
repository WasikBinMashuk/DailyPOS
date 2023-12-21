@extends('backend.master')
@section('title', 'Sell details')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-8 ">
            <div class="card">
                <div class=" card-header justify-content-between ">
                    <div>
                        <h3 class="card-title">Sell Details</h3>
                    </div>
                    <div>
                        <div class="d-inline">
                            {{-- <a class="btn btn-info" href="{{ route('details.create') }}">Add detail</a> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sell ID</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellDetails as $detail)
                                <tr>
                                    <th>{{ $detail->sell_id }}</th>
                                    <td>{{ $detail->product->id }}</td>
                                    <td>{{ $detail->product->product_name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->price }}</td>
                                    <td>{{ $detail->total_price }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- {{ $sellDetails->links('pagination::bootstrap-5') }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
