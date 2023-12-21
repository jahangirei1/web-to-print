@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success my-3">
                {{ session('success') }}
            </div>
        @endif
        <div class="card my-5">
            <div class="card-header">
                Add New Admin
            </div>
            <div class="card-body">
                <form action="{{ route('admin-add') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input name="first_name" required type="text" class="form-control" id="admin_first_name">
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input name="last_name" required type="text" class="form-control" id="admin_last_name">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" required type="email" class="form-control" id="admin_email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" required type="password" class="form-control" id="admin_password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input name="password_confirmation" required type="password" class="form-control" id="admin_password">
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Select Role</label>
                        <select name="role" required class="form-select">
                            <option value="0">Admin</option>
                            <option value="1">Super Admin</option>
                        </select>
                    </div>


                    <button type="submit" class="btn btn-outline-warning">Submit</button>
                    @if ($errors->any())
                        <div class="alert alert-danger my-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection