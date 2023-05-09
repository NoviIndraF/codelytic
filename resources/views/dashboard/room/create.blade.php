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
                                <h4>Tambah Kelas</h4>
                            </div>
                        </div>
                    </div>
                    <form class="form-valide mt-24" action="/dashboard/rooms" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="name">Nama kelas <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="name" name="name" placeholder="Masukkan Nama Kelas..." required value="{{ old('name') }}">
                            </div>
                            @error('name') 
                            <h6 class="text-danger">* 
                                {{ $message }}
                            </h6>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="slug">Slug<span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="slug" slug="slug"  required value="{{ old('slug') }}">
                            </div>
                            @error('slug') 
                            <h6 class="text-danger">* 
                                {{ $message }}
                            </h6>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="major">Jurusan <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="major" name="major" placeholder="Masukkan Nama Jurusan..." required value="{{ old('major') }}">
                                @error('major') 
                                    <h6 class="text-danger">* 
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="description">Deskripsi/catatan
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="description" name="description" placeholder="Deskripsi Kelas" value="{{ old('description') }}">
                                @error('description') 
                                    <h6 class="text-danger">* 
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-8">
                                <button class="btn login-form__btn submit" type="submit">Tambah Kelas</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
</div>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
        fetch('/dashboard/rooms/checkSlug?name='+name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })
</script>
@endsection