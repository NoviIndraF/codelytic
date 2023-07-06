@extends('dashboard.layouts.main')
<style>
    .ck-editor__editable_inline{
        height: 500px;
    }
    .ck-content .image {
                /* block images */
                max-width: 50%;
                margin: 20px auto;
            }
</style>
@section('container')
<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-10">
                                <h4>Edit Kelompok Diskusi</h4>
                            </div>
                        </div>
                    </div>
                    <form class="form-valide mt-24" action="/dashboard/groups/{{ $group->slug }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="title">Judul Kelompok Diskusi <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="name" name="name" placeholder="Masukkan Judul Kelompok Diskusi..." required value="{{ old('name', $group->name) }}">
                                @error('name') 
                                <h6 class="text-danger">* 
                                    {{ $message }}
                                </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="slug">Slug <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" id="slug" name="slug"  readonly required value="{{ old('slug', $group->slug) }}">
                                @error('slug') 
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
                                <input type="text" class="form-control input-default" id="description" name="description" placeholder="Deskripsi Kelompok Diskusi..." value="{{ old('description', $group->description) }}">
                                @error('description') 
                                    <h6 class="text-danger">* 
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-9"></div>
                            <div class="col-lg-3">
                                <input type="hidden" id="discussion_id" name="discussion_id" value="{{ $discussion_id}}">
                                <button class="btn login-form__btn submit" type="submit">Edit Kelompok Diskusi</button>
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
        fetch('/dashboard/groups/checkSlug?name='+name.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })
</script>
@endsection