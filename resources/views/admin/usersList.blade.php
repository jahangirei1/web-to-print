@extends('layouts.app')

@section('content')
    <div class="container mt-5 border border-secondary rounded">
        <table class="table caption-top">
            <caption>List of Approved Members</caption>
            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($data[0] as $key => $value)
                        <th scope="col">{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        @foreach ($row as $key => $value)
                            @if ($key == 'type')
                                @if ($value == '2')
                                    <td>Creative Member</td>
                                @else
                                    <td>Commerce Member </td>
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
@endsection

{{-- @extends('layouts.app')

@section('content')
    <div class="container mt-5 border border-secondary rounded">
        <table class="table caption-top">
            <caption>List of Approved Members</caption>
            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($data[0] as $key => $value)
                        <th scope="col">{{ $key }}</th>
                    @endforeach
                    <th>Member Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        @foreach ($row as $key => $value)
                            <td>
                                @if ($key == 'type')
                                    @if ($value == '2')
                                        Creative Member
                                    @else
                                        Commerce Member
                                    @endif
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection --}}
