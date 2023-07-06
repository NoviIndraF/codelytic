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
                                <h3>Group Siswa</h3>
                                <h5>Group :{{ $group->name }}</h5>
                                <p>{{ $group->description }}</p>
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
                        @if (!$group->student_group->isEmpty())
                        <div class="row">
                            <div class="col-lg-9">
                                <h4>Daftar Siswa</h4>
                            </div>
                                <div class="col-lg-2">
                                    <form action="/dashboard/groups/showComment" method="post">
                                        @csrf
                                            <button type="submit" class="btn mb-1 btn-primary ml-2">Lihat Diskusi<span class="btn-icon-right"><i class="fa fa-eye"></i></span></button>
                                            <input type="hidden" id="group_id" name="group_id" value="{{ $group->id }}">
                                    </form>
                                </div>
                        </div>
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th class="col-sm-1">#</th>
                                <th class="col-md-4">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentGroup as $student_group)       
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $student_group->student->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        @else
                        <p>Belum ada siswa yang bergabung di group ini...</p>
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