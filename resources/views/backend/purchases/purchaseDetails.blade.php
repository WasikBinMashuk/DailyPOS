@extends('backend.master')
@section('title', 'Purchase details')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-8 ">
            <div class="card">
                <div class=" card-header justify-content-between ">
                    <div>
                        <h3 class="card-title">Purchase Detail</h3>
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
                                <th scope="col">Purchase ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Price</th>
                                {{-- <th scope="col">Actions</th> --}}
                                {{-- <th scope="col"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchaseDetails as $detail)
                                <tr>
                                    <th>{{ $detail->purchase_id }}</th>
                                    <td>{{ $detail->product->product_name }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>{{ $detail->price }}</td>
                                    <td>{{ $detail->total_price }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- {{ $purchaseDetails->links('pagination::bootstrap-5') }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
