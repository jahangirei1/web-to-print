{{-- @extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <div class="container mt-5 border border-secondary rounded">
        <table class="table caption-top">
            <caption>List of Pending Users</caption>
            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($data[0] as $key => $value)
                        <th scope="col">{{ $key }}</th>
                    @endforeach
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    @foreach ($row as $key => $value)
                        @if ($key == 'status')
                            @if ($value == '0')
                                <td>status = 0 , pending user</td>
                            @endif
                        @else
                            <td>{{ $value }}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}

@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <div class="container mt-5 border border-secondary rounded">
        @if ($noPendingUsers)
            <p>No pending users to display.</p>
        @else
            <table class="table caption-top">
                <caption>List of Pending Users</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach ($data[0] as $key => $value)
                            <th scope="col">{{ $key }}</th>
                        @endforeach
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            @php
                                $rowArray = json_decode(json_encode($row), true); //$row is cast to an array using json_decode(json_encode($row), true). This ensures that you are working with an array, not an object, and should resolve the "Cannot use object of type stdClass as array" error
                            @endphp
                            @foreach ($rowArray as $key => $value)
                                @if ($key == 'status')
                                    <td>
                                        @if ($value == '0')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                @else
                                    <td>{{ $value }}</td>
                                @endif
                            @endforeach
                            <td>
                                @if ($rowArray['status'] == '0')
                                    <form action="{{ route('approve.user', $rowArray['user_details_id']) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('reject.user', $rowArray['user_details_id']) }}" method="post" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
