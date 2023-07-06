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
                                <h3>Group Diskusi Siswa</h3>
                                <h5>Group :{{ $group->name }}</h5>
                                <p>{{ $group->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-2">
                        @if (!$group->student_group->isEmpty())
                        <div class="row">
                            <div class="col-lg-4">
                                <h4>Diskusi</h4>
                            </div>
                            <div class="col-lg-2">
                                <form action="/dashboard/groups/showComment" method="post">
                                    @csrf
                                        <button type="submit" class="btn mb-1 btn-primary ml-2">Refresh<span class="btn-icon-right"><i class="fa fa-refresh"></i></span></button>
                                        <input type="hidden" id="group_id" name="group_id" value="{{ $group->id }}">
                                </form>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                            @foreach ($studentGroupComment as $comment)  
                            @if ($comment->user_id == 0)
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                        <div class="media-body">
                                            <h5>{{ $comment->student->name }}</h5>
                                            <p class="mb-0">{{ $comment->message }}</p>
                                        </div>
                                        <span class="text-muted">{{ $comment->created_at }}</span>
                                        <div class="col-lg-2"></div>
                                    </div>
                                @else
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                        <div class="media-body">
                                            <h5>{{ $comment->user->name }}</h5>
                                            <p class="mb-0">{{ $comment->message }}</p>
                                        </div>
                                        <span class="text-muted">{{ $comment->created_at }}</span>
                                        <div class="col-lg-2">
                                            <form action="/dashboard/studentGroupComments/updateHide" method="post" class="d-inline">
                                                @csrf
                                                <button onclick="return confirm('Apakah anda yakin ingin mengahapus pesan ini: {{ $comment->message }}?')" class="btn mb-1 btn-danger ml-2"><i class="fa fa-trash"></i>
                                                </button>
                                                <input type="hidden" id="comment_id" name="comment_id" value="{{ $comment->id }}">
                                                <input type="hidden" id="group_id" name="group_id" value="{{ $group->id }}">
                                            </form>
                                        </div>
                                       
                                    </div>
                                @endif
                            @endforeach
                    </div>
                    <div class="col-lg-1">
                    </div>
                    <div class="col-lg-3">
                        <form action="/dashboard/studentGroupComments/" method="post" >
                            @csrf
                            <div class="form-group">
                                <label>Pesan :</label>
                                <textarea class="form-control h-150px" rows="6" id="message" name="message" placeholder="Pesan..." required></textarea>
                                @error('message') 
                                <h6 class="text-danger">* 
                                    {{ $message }}
                                </h6>
                            @enderror

                            <input type="hidden" id="group_id" name="group_id" value="{{ $group->id}}">
                            </div>
                            <div>
                                <button class="btn login-form__btn submit" type="submit" type="submit" class="btn mb-1 mr-5 btn-primary">Kirim Pesan<span class="btn-icon-right"><i class="fa fa-send"></i></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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