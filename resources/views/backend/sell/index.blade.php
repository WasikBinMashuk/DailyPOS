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
                                {{-- <span class="badge bg-light text-dark fw-semibold fs-4">{{ $branch->branch_name }}
                                    Branch</span> --}}
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
                                        <td><span class="text-capitalize">{{ $sell->sellPayment->payment_method }}</span>
                                        </td>
                                        <td>
                                            @if ($sell->sellPayment->due > 0.0)
                                                <span
                                                    class="badge bg-warning fs-5 me-3">{{ $sell->sellPayment->due }}&#2547;</span>
                                            @else
                                                {{ $sell->sellPayment->due }}
                                            @endif
                                        </td>
                                        <td>{{ $sell->sellPayment->paid }}&#2547;</td>
                                        <td>{{ $sell->subtotal }}&#2547;</td>
                                        <td class="d-flex gap-1">
                                            <a href="{{ route('sells.show', $sell->id) }}" class="btn btn-info">
                                                <i class="fa-regular fa-eye" style="color: #ffffff;"></i>
                                            </a>
                                            <form action="{{ route('sells.update', $sell->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success form-submit-sweetAlert"
                                                    @if ($sell->sellPayment->due <= 0.0) disabled @endif>
                                                    Clear Dues
                                                </button>
                                            </form>
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

    <script type="text/javascript">
        $('.form-submit-sweetAlert').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "All Dues Paid?",
                text: "You won't be able to revert this action",
                icon: "warning",
                type: "warning",
                buttons: true,
                dangerMode: false,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
