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
                                                {{-- <a href="#" class="btn btn-primary payment-status"
                                                    data-id="{{ $sell->id }}" data-bs-toggle="modal"
                                                    data-bs-target="#payment-status-modal">
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

    <div class="modal modal-blur fade" id="payment-status-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" id="modalForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <select class="form-select" name="status" id="orderStatus">
                                        <option value="1" selected>Paid</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="sumbit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24"
                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- <script>
        $(document).on("click", ".payment-status", function() {

            var sellId = $(this).data('id');

            let link = "{{ route('sells.modal.update') }}/" + sellId + "/update";
            // console.log(link);
            $('#modalForm').attr('action', link);

            // $(".modal-body #orderStatus").val(oldStatus);
        });
    </script> --}}
@endsection
