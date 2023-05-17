@extends('authentication.main')

@section('container')

<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <a class="text-center"> <h2>Login</h2></a>

                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button> {{ session('success') }}
                                </div>
                            @endif

                            @if(session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                    </button> {{ session('loginError') }}
                                </div>
                            @endif

                            <form class="mt-5 mb-5 login-input" method="post" action="/login">
                                @csrf
                                <div class="form-group">
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                </div>
                                <button class="btn login-form__btn submit w-100" type="submit">Login</button>
                            </form>
                            <p class="mt-5 login-form__footer">Dont have account? <a href="/register" class="text-primary">Register</a> now</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
