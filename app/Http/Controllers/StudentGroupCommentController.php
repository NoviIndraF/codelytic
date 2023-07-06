<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Group;
use App\Models\StudentGroupComment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\isEmpty;

class StudentGroupCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id;
            $request->request->add([
                'user_id' => $userId,
            ]);

            $request -> validate(
                [
                'user_id' => ['required'],
                'group_id' => ['required'],
                'message' => ['required'],
                ]
            );


            $like = $request->like ?? 0;
            $hide = $request->hide ?? 0;
            $studentId = $request->student_id ?? 0;

            StudentGroupComment::create([
                'student_id' => $studentId,
                'user_id' => $userId,
                'group_id' =>$request->group_id,
                'like' => $like,
                'hide' => $hide,
                'message' => $request->message,
            ]);

            $group = Group::where('id', $request->group_id)
            ->first();

            $studentGroupComment = StudentGroupComment::
            where('group_id', $request->group_id)
            ->where('hide', 0)
            ->with(['student', 'user'])
            ->get();

            return view('dashboard.group.show_comment',[
                'group' => $group,
                'studentGroupComment' => $studentGroupComment->sortByDesc('id'),
            ]);
   
    }

    public function storeStudent(Request $request)
    {
        try {

            $studentId = auth()->user()->id;
            $request->request->add([
                'student_id' => $studentId,
            ]);

            $request -> validate(
                [
                'student_id' => ['required'],
                'group_id' => ['required'],
                'message' => ['required'],
                ]
            );


            $like = $request->like ?? 0;
            $hide = $request->hide ?? 0;
            $userId = $request->user_id ?? 0;

            StudentGroupComment::create([
                'student_id' => $request->student_id,
                'user_id' => $userId,
                'group_id' =>$request->group_id,
                'like' => $like,
                'hide' => $hide,
                'message' => $request->message,
            ]);

            return ResponseFormatter::success([
                'group_id' => $request->group_id,
            ], 'Comment Sended');

        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went error',
                'error' => $error
            ], 'Comment Send, 500');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentComment  $studentComment
     * @return \Illuminate\Http\Response
     */
    public function show(StudentGroupComment $studentComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentComment  $studentComment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentGroupComment $studentComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentCommentRequest  $request
     * @param  \App\Models\StudentComment  $studentComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentGroupComment $studentComment)
    {
        //
    }

    public function updateHide(Request $request)
    {
        $commentId = $request->comment_id;
        $comment = StudentGroupComment::where('id', $commentId)
        ->first();

        $comment->hide = 1;
        $comment->save();
       
        $group = Group::where('id', $request->group_id)
        ->first();

        $studentGroupComment = StudentGroupComment::
        where('group_id', $request->group_id)
        ->where('hide', 0)
        ->with(['student', 'user'])
        ->get();

        return view('dashboard.group.show_comment',[
            'group' => $group,
            'studentGroupComment' => $studentGroupComment->sortByDesc('id'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentComment  $studentComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentGroupComment $studentComment)
    {
        //
    }

    // API
    public function getStudentGroupCommentByGroupId(Request $request)
    {
        $group_id = $request->group_id;
        $data = StudentGroupComment::where('group_id', $group_id)
        ->where('hide', 0)
        ->with(['student', 'user'])->get();

        if($data) {
            return ResponseFormatter::success(
                $data,
                'Data Student Group Comment berhasil dipanggil'
            );
        } else {
            return ResponseFormatter::success(
                null,
                'Data Student Group Comment  Student tidak ada',
                404
            );
        }
    }


    public function updateStudentGroupCommentHide(Request $request)
    {
        $studentId = auth()->user()->id;
        $groupId = $request->group_id;
        $commentId = $request->comment_id;

        $comment = StudentGroupComment::where('id', $commentId)
        ->where('student_id', $studentId)
        ->where('group_id', $groupId)
        ->first();

    if (!$comment) {
        return ResponseFormatter::success(
            null,
            'Data Student Group Comment tidak ditemukan',
            404
        );
    }

    $comment->hide = 1;
    $comment->save();

    return ResponseFormatter::success(
        $comment,
        'Data Student Group Comment berhasil di sembunyikan'
    );
    }
}
