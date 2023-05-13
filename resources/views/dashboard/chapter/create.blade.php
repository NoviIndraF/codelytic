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
                                <h4>Tambah Konten Materi</h4>
                            </div>
                        </div>
                    </div>
                    <form class="form-valide mt-24" action="/dashboard/chapters/" method="post">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="title">Judul Konten Materi <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control input-default" id="title" name="title" placeholder="Masukkan Judul Konten Materi..." required value="{{ old('title') }}">
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
                                <input type="text" class="form-control" id="slug" name="slug"  readonly required value="{{ old('slug') }}">
                                @error('slug') 
                                <h6 class="text-danger">* 
                                    {{ $message }}
                                </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="index">Urutan
                            </label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control input-default" id="index" name="index" placeholder="Urutan Ke..." value="{{ old('index') }}">
                                @error('index') 
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
                                <input type="text" class="form-control input-default" id="description" name="description" placeholder="Deskripsi Konten Materi..." value="{{ old('description') }}">
                                @error('description') 
                                    <h6 class="text-danger">* 
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label" for="content">Konten
                            </label>
                            <div class="col-lg-8">
                                <input type="hidden" id="materi_id" name="materi_id" value="{{ $materi}}">
                                <textarea class="form-control editor " id="editor" name="content" placeholder="Deskripsi Konten Materi..." value="{{ old('content') }}"></textarea>
                                @error('content') 
                                    <h6 class="text-danger">* 
                                        {{ $message }}
                                    </h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-8">
                                <button class="btn login-form__btn submit" type="submit">Tambah Konten Materi</button>
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
        fetch('/dashboard/chapters/checkSlug?title='+title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })
</script>


<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    class MyUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }
     
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }
     
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }
     
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
     
            xhr.open( 'POST', "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}", true );
            xhr.responseType = 'json';
        }
     
        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
     
            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;
     
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }
     
                resolve( response );
            } );
     
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }
     
        _sendRequest( file ) {
            const data = new FormData();
     
            data.append( 'upload', file );
     
            this.xhr.send( data );
        }
    }
     
    function MyCustomUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new MyUploadAdapter( loader );
        };
    }
     
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            extraPlugins: [ MyCustomUploadAdapterPlugin ],
        } )
        .catch( error => {
            console.error( error );
        } );
    </script>
@endsection