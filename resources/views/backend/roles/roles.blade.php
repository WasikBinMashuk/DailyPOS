@extends('backend.master')
@section('title', 'Categories')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class=" card-header justify-content-between ">
                        <div>
                            <h3 class="card-title">Roles ({{ $roles->total() }})</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">Category ID</th> --}}
                                    <th scope="col">Role Name</th>
                                    <th scope="col"></th>
                                    {{-- <th scope="col"></th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>

                                        <td style="width: 100px">
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-primary">
                                                    <i class="fa-regular fa-pen-to-square" style="color: #ffffff;"></i>
                                                </a>
                                                <a href="{{ route('category.delete', $item->id) }}" class="btn btn-danger"
                                                    onclick="confirmation(event)">
                                                    <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $roles->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
