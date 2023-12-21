{{-- @extends('layouts.app')

@section('content')
    <form action="{{route('login.post')}}" method="post">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="user-email">

        <label for="password">Password</label>
        <input type="password" name="password" id="user-password">

        <input type="submit" value="LogIn">
    </form>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection --}}

  {{-- <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbs5noeZgBm7JwxK5J47UpmeOVfyIa1KC9KJfvoULf/SfM5v2bUoAbK70qUs/i2l" crossorigin="anonymous">
    
    @includeIf('includes.styles')
  </head>
  <body>
    <div class="container px-4 py-5 mx-auto">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
                <div class="card card1">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-10 my-5">
                            <div class="row justify-content-center px-3 mb-3">
                                <img id="logo" src="https://i.imgur.com/PSXxjNY.png">
                            </div>
                            <h3 class="mb-5 text-center heading">Welcome to Web To Print</h3>
    
                            <h6 class="msg-info">Please login to your account</h6>
    
                            <div class="form-group">
                                <label class="form-control-label text-muted">Email</label>
                                <input type="text" id="email" name="email" class="form-control">
                            </div>
    
                            <div class="form-group">
                                <label class="form-control-label text-muted">Password</label>
                                <input type="password" id="psw" name="psw" class="form-control">
                            </div>
    
                            <div class="row justify-content-center my-3 px-3">
                                <button class="btn-block btn-color">Login</button>
                            </div>
    
                          
                        </div>
                    </div>
                    
                </div>
                <div class="card card2">
                    <div class="my-auto mx-md-5 px-md-5 right">
                        <h3 class="text-white">We are more than just a company</h3>
                        <small class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </body>
  </html> --}}

  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbs5noeZgBm7JwxK5J47UpmeOVfyIa1KC9KJfvoULf/SfM5v2bUoAbK70qUs/i2l" crossorigin="anonymous">
    @includeIf('includes.styles')
</head>
<body>
    <div class="container px-4 py-5 mx-auto">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
                <div class="card card1">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-10 my-5">
                            <h3 class="mb-5 text-center heading">Welcome to Web To Print</h3>
    
                            <h6 class="msg-info">Please login to your account</h6>
    
                            <form action="{{ route('login.post') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label text-muted">Email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
    
                                <div class="form-group">
                                    <label class="form-control-label text-muted">Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
    
                                <div class="row justify-content-center my-3 px-3">
                                    <button type="submit" class="btn-block btn-color">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card card2">
                    <div class="my-auto mx-md-5 px-md-5 right">
                        <h3 class="text-white">We are more than just a company</h3>
                        <small class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
