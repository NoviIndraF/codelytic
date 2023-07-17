@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4>Edit Profile</h4>
                            </div>
                        </div>
                    </div>
                    <form class="form-valide mt-24" action="/dashboard/users/{{ $user->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="name">Nama <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="name" name="name" placeholder="Masukkan Nama Anda..." required value="{{ old('name', $user->name) }}">
                                @error('name') 
                                <h6 class="text-danger">* 
                                    {{ $message }}
                                </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="name">Username <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="username" name="username" placeholder="Masukkan Username Anda..." required value="{{ old('username', $user->username) }}">
                                @error('username') 
                                <h6 class="text-danger">* 
                                    {{ $message }}
                                </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-8">
                                <button class="btn login-form__btn submit" type="submit">Simpan Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
</div>
@endsection