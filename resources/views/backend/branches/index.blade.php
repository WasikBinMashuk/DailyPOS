@extends('backend.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div>
                            <h3 class="card-title">Branch List</h3>
                        </div>
                        <div>

                            <div class="d-inline">
                                <a class="btn btn-info" href="{{ route('branches.create') }}">Add</a>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Category ID</th> --}}
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td>{{ $branch->branch_name }}</td>
                                        <td>{{ $branch->mobile }}</td>
                                        <td>{{ $branch->address }}</td>
                                        <td style="width: 150px;">
                                            <div style="display: flex; gap: 2px;">
                                                <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-primary">
                                                    <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                                </a>
                                                <form id="deleteForm" action="{{ route('branches.destroy', $branch->id) }}"
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

                        {{ $branches->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
