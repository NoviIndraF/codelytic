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
                                <h4>Edit Materi</h4>
                            </div>
                        </div>
                    </div>
                    <form class="form-valide mt-24" action="/dashboard/materis/{{ $materi->slug }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="title">Judul Materi <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="title" name="title" placeholder="Masukkan Judul Materi..." required value="{{ old('title', $materi->title) }}">
                                @error('title') 
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
                                <input type="text" class="form-control" id="slug" name="slug"  readonly required value="{{ old('slug', $materi->slug) }}">
                                @error('slug') 
                                <h6 class="text-danger">* 
                                    {{ $message }}
                                </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="room" class="col-lg-3 col-form-label">Kelas </label><span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                            <select class="form-control" name="room_id">
                                @foreach ($rooms as $room)
                                    @if(old('room_id', $materi->room_id) == $room->id)
                                        <option value="{{ $room->id }}" selected>{{ $room->name }}</option>
                                    @else
                                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="description">Deskripsi/catatan
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="description" name="description" placeholder="Deskripsi Materi..." value="{{ old('description', $materi->description) }}">
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
                                <button class="btn login-form__btn submit" type="submit">Simpan Konten Materi</button>
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
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
        fetch('/dashboard/materis/checkSlug?title='+title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })
</script>
@endsection