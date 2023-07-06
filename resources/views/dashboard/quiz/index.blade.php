@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid mt-3 mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-12 col-sm-6">
                                <div class="card gradient-1">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">Kuis</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white">{{ $count_quiz }}</h2>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="fa fa-star"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button> {{ session('success') }}
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <h4>Daftar Kuis</h4>
                        </div>
                        <div class="col-lg-2">
                            <a href="/dashboard/quizzes/create" type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Kuis<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th class="col-md-1">#</th>
                                    <th class="col-md-1">Judul Kuis</th>
                                    <th class="col-md-2">Kelas</th>
                                    <th>Level</th>
                                    <th class="col-md-4">Deskripsi</th>
                                    <th class="col-md-1">Jumlah Pertanyaan</th>
                                    <th class="col-md-2">Jumlah Siswa Mengisi Kuis</th>
                                    <th class="col-md-2">Status</th>
                                    <th class="col-md-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $quiz)       
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $quiz->title }}</td>
                                    <td>{{ $quiz->room->name }}</td>
                                    <td>
                                        @if ( $quiz->level == 1)Mudah
                                        @elseif ( $quiz->level == 2)Normal
                                        @elseif ( $quiz->level == 3)Sulit
                                        @elseif ( $quiz->level == 4)Expert
                                        @else
                                        @endif
                                    </td>
                                    <td>{{ $quiz->description }}</td>
                                    <td>{{ $quiz->question->count() }}</td>
                                    <td>
                                        <div class="row justify-content-center align-items-center">
                                            <div>
                                               </div>
                                                <div>
                                                    <form action="/dashboard/quizzes/showStudentQuiz" method="post">
                                                        @csrf
                                                                <button type="submit" class="btn mb-1 btn-primary ml-2"> {{ $quiz->student_quiz->count() }}    <i class="fa fa-eye"></i></button>
                                                                <input type="hidden" id="id" name="id" value="{{ $quiz->id }}">
                                                    </form>
                                                </div>
                                       
                                        </div>
                                    </td>
                                    <td>
                                        <form action="/dashboard/quizzes/updateStatus" method="post">
                                            @csrf
                                                @if ( $quiz->status == 1)
                                                    <button type="submit" onclick="return confirm('Apakah anda ingin menonaktifkan tugash : {{ $quiz->title }}?')" class="btn mb-1 btn-rounded btn-success">Aktif</button>
                                                @else
                                                    <button type="submit" onclick="return confirm('Apakah anda ingin mengaktifkan tugash : {{ $quiz->title }}?')" class="btn mb-1 btn-rounded btn-danger">Nonaktif</button>
                                                @endif
                                                <input type="hidden" id="id" name="id" value="{{ $quiz->id }}">
                                        </form>
                                    </td>
                                    <td> 
                                        <div class="row">
                                            <a href="/dashboard/quizzes/{{ $quiz->slug }}" class="btn mb-1 btn-primary ml-2"><i class="fa fa-eye"></i>
                                            </a>

                                            <a href="/dashboard/quizzes/{{ $quiz->slug }}/edit" class="btn mb-1 btn-warning ml-2"><i class="fa fa-edit"></i>
                                            </a>
                                            
                                            <form action="/dashboard/quizzes/{{ $quiz->slug }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button onclick="return confirm('Apakah anda ingin menghapus kuis: {{ $quiz->title }}?')" class="btn mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                        </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
</div>

@endsection