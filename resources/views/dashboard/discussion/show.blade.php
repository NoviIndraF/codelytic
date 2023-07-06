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
                                <h3>Diskusi : {{ $discussion->title }}</h3>
                                <h6>Kelas :{{ $discussion->room->name }}</h6>
                                <p>{{ $discussion->description }}</p>
                            </div>
                        </div>
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                                </button> {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive mt-2">
                        @if (!$groups->isEmpty())
                        <div class="row">
                            <div class="col-lg-9">
                                <h4>Kelompok Diskusi : </h4>
                            </div>
                            <div class="col-lg-3">
                                <a href={{ route('groups.create', ['discussion_id' => $discussion->id]) }} type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Kelompok Diskusi<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                                </a>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th class="col-sm-1">#</th>
                                <th class="col-md-1">Nama Kelompok</th>
                                <th class="col-md-2">Code</th>
                                <th class="col-md-4">Deskripsi</th>
                                <th class="col-md-2">Jumlah Siswa</th>
                                <th class="col-md-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)       
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->code }}</td>
                                <td>{{ $group->description }}</td>
                                <td><a href="/dashboard/groups/{{ $group->slug }}" class="btn mb-1 btn-primary ml-2">{{ $group->student_group->count() }} <i class="fa fa-eye"></i>
                                </a></td>
                                <td> 
                                    <div class="row">
                                        <a href="/dashboard/groups/{{ $group->slug }}/edit" class="btn mb-1 btn-warning ml-2"><i class="fa fa-edit"></i>
                                        </a>
                                        
                                        <form action="/dashboard/groups/{{ $group->slug }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button onclick="return confirm('Apakah anda ingin menghapus {{ $group->title }}?')" class="btn sweet-success-cancel mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        @else
                        <p>Anda belum memiliki Kelompok Diskusi...</p>
                        <a href={{ route('groups.create', ['discussion_id' => $discussion->id]) }} type="submit" class="btn mb-1 mr-5 btn-primary">Tambah Kelompok Diskusi<span class="btn-icon-right"><i class="fa fa-plus-circle"></i></span>
                        </a>
                        @endif
                        
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
    </div>
</div>

<script>
    document.querySelector(".sweet-success-cancel")
    .onclick=function(){
        swal({
            title:"Are you sure to delete ?",
            text:"You will not be able to recover this imaginary file !!",
            type:"warning",
            showCancelButton:!0,
            confirmButtonColor:"#DD6B55",
            confirmButtonText:"Yes, delete it !!",
            cancelButtonText:"No, cancel it !!",
            closeOnConfirm:!1,
            closeOnCancel:!1},
            function(e){
                e
                ?swal("Deleted !!","Hey, your imaginary file has been deleted !!","success")
                :swal("Cancelled !!","Hey, your imaginary file is safe !!","error")})},
</script>

@endsection