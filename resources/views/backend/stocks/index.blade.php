@extends('backend.master')
@section('title', 'Stocks')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div>
                            <h3 class="card-title">Stock History ({{ $stocks->total() }})</h3>
                        </div>
                        <div>

                            <div class="d-inline">
                                {{-- <a class="btn btn-info" href="{{ route('stocks.create') }}">Add</a> --}}
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Category ID</th> --}}
                                    <th scope="col">SL</th>
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Source</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Date</th>
                                    {{-- <th scope="col"></th> --}}

                                </tr>
                            </thead>
                            {{-- @php
                                $serialNumber = 1;
                            @endphp --}}
                            <tbody>
                                @foreach ($stocks as $key => $stock)
                                    <tr>
                                        <td>{{ $stocks->firstItem() + $key }}</td>
                                        <td>{{ $stock->branch->branch_name }}</td>
                                        <td>{{ $stock->product->product_name }}</td>
                                        <td>{{ $stock->source }}</td>
                                        <td>{{ $stock->quantity }}</td>
                                        <td>{{ $stock->date }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $stocks->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
