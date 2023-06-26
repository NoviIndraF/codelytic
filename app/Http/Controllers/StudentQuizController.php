<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateStudentQuizRequest;
use App\Models\StudentQuiz;
use App\Helpers\ResponseFormatter;

class StudentQuizController extends Controller
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
     * @param  \App\Http\Requests\StoreStudentQuizRequest  $request
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
                'quiz_id' => ['required'],
                'room_id' => ['required'],
                'score' => ['required'],
                'sended' => ['required'],
                ]
            );

            StudentQuiz::create([
                'student_id' => $request->student_id,
                'quiz_id' => $request->quiz_id,
                'room_id' => $request->room_id,
                'score' =>$request->score,
                'sended' =>$request->sended,
            ]);

            return ResponseFormatter::success([
                'score' => $request->score,
            ], 'Quiz Submitted');

        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went error',
                'error' => $error
            ], 'Quiz Submit Failed ');
    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentQuiz  $studentQuiz
     * @return \Illuminate\Http\Response
     */
    public function show(StudentQuiz $studentQuiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentQuiz  $studentQuiz
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentQuiz $studentQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentQuizRequest  $request
     * @param  \App\Models\StudentQuiz  $studentQuiz
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentQuizRequest $request, StudentQuiz $studentQuiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentQuiz  $studentQuiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentQuiz $studentQuiz)
    {
        //
    }

    public function getStudentQuizById(Request $request){

        try{
            
            $studentId = auth()->user()->id;
            $roomId = $request->room_id; 
            $quizId = $request->quiz_id; 

            $studentQuiz = StudentQuiz::where('room_id', $roomId)
        ->where('student_id', $studentId)
        ->where('quiz_id', $quizId)
        ->with('quiz')
        ->get();

            if($studentQuiz){
                return ResponseFormatter::success(
                    $studentQuiz,
                    'Data Student Quiz berhasil dipanggil'
                );
            } else{
                return ResponseFormatter::success(
                    [],
                    'Data Student Quiz kosong',
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

    public function getStudentQuizByRoomId(Request $request){

        try{
            
            $studentId = auth()->user()->id;
            $roomId = $request->room_id; 

            $studentQuiz = StudentQuiz::where('room_id', $roomId)
        ->where('student_id', $studentId)
        ->with('quiz')
        ->get();

            if($studentQuiz){
                return ResponseFormatter::success(
                    $studentQuiz,
                    'Data Student Quiz berhasil dipanggil'
                );
            } else{
                return ResponseFormatter::success(
                    [],
                    'Data Student Quiz kosong',
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
