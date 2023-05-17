@extends('authentication.main')

@section('container')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            
                            <a class="text-center " href=""> <h2>Register</h2></a>
    
                            <form class="form-valide mt-24" action="/register" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="name">Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-default" id="name" name="name" placeholder="Enter your name.." required value="{{ old('name') }}">
                                    </div>
                                    @error('name') 
                                    <h6 class="text-danger">* 
                                        {{ $message }}
                                    </h6>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="username">Username <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-default" id="username" name="username" placeholder="Enter a username.." required value="{{ old('username') }}">
                                        @error('username') 
                                            <h6 class="text-danger">* 
                                                {{ $message }}
                                            </h6>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-default" id="email" name="email" placeholder="Your valid email.." required value="{{ old('email') }}">
                                        @error('email') 
                                            <h6 class="text-danger">* 
                                                {{ $message }}
                                            </h6>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="password">Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control input-default" id="password" name="password" placeholder="Choose a safe one.." required>
                                        @error('password') 
                                            <h6 class="text-danger">* 
                                                {{ $message }}
                                            </h6>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="..and confirm it!" required>
                                    </div>
                                </div>
                                <button class="btn login-form__btn submit w-100" type="submit">Register</button>
                            </form>
                                <p class="mt-5 login-form__footer">Have account <a href="/login" class="text-primary">Login</a> now</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection