@extends('backend.master')
@section('content')
    <div class="page-wrapper mt-5" style="display: flex; justify-content: center; flex-direction:row">
        <div class="col-md-6 ">
            <form action="{{ route('purchases.update', $editPurchase->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h2>Update Purchase</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            {{-- <div class="col-md-6 mb-3">
                                <label class="form-label ">Date</label>
                                <div>
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        name="date" value="{{ $editPurchase->date }}">
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Date</label>
                                <div class="input-icon mb-2">
                                    <input class="form-control" name="date" placeholder="Select a date"
                                        id="datepicker-icon" value="{{ $editPurchase->date }}" />
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Select Supplier</label>
                                <div>
                                    <select name="supplier_id" class="form-select" id="category">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                {{ $editPurchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->supplier_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Status</label>
                                <div>
                                    @if ($editPurchase->status == 'received')
                                        <select name="status" class="form-select" disabled>
                                            <option selected>
                                                Received
                                            </option>
                                        </select>
                                        {{-- <input type="text" value="received" name="status" readonly> --}}
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    @else
                                        <select name="status" class="form-select">
                                            <option value="received"
                                                {{ $editPurchase->status == 'received' ? 'selected' : '' }}>
                                                Received
                                            </option>
                                            <option value="pending"
                                                {{ $editPurchase->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label required">Payment Method</label>
                                <div>
                                    <select name="payment_method" class="form-select">
                                        <option value="cod"
                                            {{ $editPurchase->payment_method == 'cod' ? 'selected' : '' }}>
                                            COD
                                        </option>
                                        <option value="online"
                                            {{ $editPurchase->payment_method == 'online' ? 'selected' : '' }}>
                                            Online
                                        </option>
                                    </select>
                                    @error('payment_method')
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

    {{-- Datepicker script --}}
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            window.Litepicker &&
                new Litepicker({
                    element: document.getElementById("datepicker-icon"),
                    buttonText: {
                        previousMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                        nextMonth: `<!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
                    },
                });
        });
        // @formatter:on
    </script>
@endsection
