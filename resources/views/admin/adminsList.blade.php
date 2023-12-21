{{-- @extends('layouts.app')

@section('content')
    <div class="container mt-5">

        @if (auth()->user()->type == 1)
            <div class="container text-end">
                <a href="{{ route('admin-add-form') }}"><button class="btn btn-outline-warning mx-5">Add Admin</button></a>
            </div>
        @endif

        <table class="table caption-top border border-secondary rounded">
            <caption>List of Admins</caption>

            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($data[0] as $key => $value)
                        <th scope="col">{{ $key }}</th>
                    @endforeach
                    @if (auth()->user()->type == 1)
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        @foreach ($row as $key => $value)
                            <td>{{ $value }}</td>
                        @endforeach
                        @if (auth()->user()->type == 1)
                        <td>
                            <a class="btn btn-danger" href="{{route('admin-delete')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></a>
                            <a class="btn btn-primary" href="{{route('admin-update')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update"><i class="fa-solid fa-pen"></i></a>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection --}}

@extends('layouts.app')

@section('content')
    <div class="container mt-5">

        @if (auth()->user()->type == 1)
            <div class="container text-end">
                <a href="{{ route('admin-add-form') }}"><button class="btn btn-outline-warning mx-5">Add Admin</button></a>
            </div>
        @endif
        {{-- {{ dd($data) }} --}}

        <table class="table caption-top border border-secondary rounded">
            <caption>List of Admins</caption>

            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($data[0] as $key => $value)
                        <th scope="col">{{ $key }}</th>
                    @endforeach
                    @if (auth()->user()->type == 1)
                        <th>Delete</th>
                        <th>Update Role</th> {{-- New column for updating role --}}
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        @foreach ($row as $key => $value)
                            <td>{{ $value }}</td>
                        @endforeach
                        @if (auth()->user()->type == 1)
                            <td>
                                <form action="{{ route('admin-delete',['id'=>$row['id']]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                {{-- <a class="btn btn-primary" href="{{route('admin-update')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Update">
                                    <i class="fa-solid fa-pen"></i>
                                </a> --}}
                            </td>
                            <td>
                                <form action="{{ route('admin-update-role', ['id' => $row['id']]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="mb-3">
                                        <select class="form-select" name="role" aria-label="Select Role">
                                            <option value="0" @if ($row['type'] == 0) selected @endif>Admin</option>
                                            <option value="1" @if ($row['type'] == 1) selected @endif>Super Admin</option>
                                            {{-- Add other role options as needed --}}
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update Role</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
