<?php

namespace App\Http\Controllers;

use App\Models\StudentRoom;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Exception;

class StudentRoomController extends Controller
{
    public function getStudentRoom()
    {
        $studentId = auth()->user()->id;
        $data = StudentRoom::where('student_id', $studentId)->with('room')->get();

        if($data){
            return ResponseFormatter::success(
                $data,
                'Data Room Student berhasil dipanggil'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Room Student tidak ada',
                404
            );
        }
    }

    public function getAllData()
    {
        $data = StudentRoom::where('student_id', auth()->user()->id)->get();

        if($data){
            return ResponseFormatter::success(
                $data,
                'Data Room Student berhasil dipanggil'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Room Student tidak ada',
                404
            );
        }

        return ResponseFormatter::success(
            $data,
            'Data Room Student berhasil diambil'
        );
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
                'code' => ['required', 'string'],
                'room_id' => ['required'],
                ]
            );

            StudentRoom::create([
                'student_id' => $request->student_id,
                'code' =>$request->code,
                'room_id' => $request->room_id,
            ]);

            return ResponseFormatter::success([
                'room_id' => $request->room_id,
            ], 'Room Registered');

        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went error',
                'error' => $error
            ], 'Auth Class Failed, 500');
    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentRoom  $studentRoom
     * @return \Illuminate\Http\Response
     */
    public function show(StudentRoom $studentRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentRoom  $studentRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentRoom $studentRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentRoom  $studentRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentRoom $studentRoom)
    {
        //
    }
}
