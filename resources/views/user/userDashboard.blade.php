@extends('layouts.app')

@section('navbar')
<a href="{{route('user-logout')}}">User Log Out</a>
@endsection

@section('content')
<h1>User Dashboard</h1>
@endsection