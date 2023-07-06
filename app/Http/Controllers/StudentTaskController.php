<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentTask;
use App\Helpers\ResponseFormatter;
use Exception;

class StudentTaskController extends Controller
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
     * @param  \App\Http\Requests\StoreStudentTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $studentId = auth()->user()->id;
            $request->request->add([
                'student_id' => $studentId,
            ]);

            $request -> validate(
            [
                'student_id' => ['required'],
                'task_id' => ['required'],
                'room_id' => ['required'],
                'answer' => ['required'],
                'sended' => ['required'],
                ]
            );

            StudentTask::create([
                'student_id' => $request->student_id,
                'task_id' => $request->task_id,
                'room_id' => $request->room_id,
                'answer' =>$request->answer,
                'sended' =>$request->sended,
            ]);

            return ResponseFormatter::success([
                'answer' => $request->answer,
            ], 'Task Submitted');

        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went error',
                'error' => $error
            ], 'Task Submit Failed ');
    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentTask  $studentTask
     * @return \Illuminate\Http\Response
     */
    public function show(StudentTask $studentTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentTask  $studentTask
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentTask $studentTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentTaskRequest  $request
     * @param  \App\Models\StudentTask  $studentTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentTask $studentTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentTask  $studentTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentTask $studentTask)
    {
        //
    }
    
    // API


    public function getStudentTask (Request $request){

        try{
            
            $studentId = auth()->user()->id;
            $roomId = $request->room_id; 

            $studentTask = StudentTask::where('room_id', $roomId)
        ->where('student_id', $studentId)
        ->with('task')
        ->get();

            if($studentTask){
                return ResponseFormatter::success(
                    $studentTask,
                    'Data Student Task berhasil dipanggil'
                );
            } else{
                return ResponseFormatter::success(
                    [],
                    'Data Student Task kosong',
                    404
                );
            }
        }
        catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went error',
                'error' => $error
            ], 'Get Data Failed ');
    
        }
    }
}
