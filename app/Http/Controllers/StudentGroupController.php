<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\ResponseFormatter;
use App\Models\StudentGroup;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
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
     * @param  \App\Http\Requests\StoreStudentDiscussionGroupRequest  $request
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
                'group_id' => ['required'],
                'room_id' => ['required'],
                ]
            );

            StudentGroup::create([
                'student_id' => $request->student_id,
                'group_id' =>$request->group_id,
                'room_id' => $request->room_id,
            ]);

            return ResponseFormatter::success([
                'group_id' => $request->group_id,
            ], 'Group Registered');

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
     * @param  \App\Models\StudentDiscussionGroup  $studentDiscussionGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Request $studentDiscussionGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentDiscussionGroup  $studentDiscussionGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $studentDiscussionGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentDiscussionGroupRequest  $request
     * @param  \App\Models\StudentDiscussionGroup  $studentDiscussionGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Request $studentDiscussionGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentDiscussionGroup  $studentDiscussionGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $studentDiscussionGroup)
    {
        //
    }

    // API

    public function getStudentGroupByRoomId(Request $request)
    {
        try{
            $studentId = auth()->user()->id;
        $roomId = $request->room_id;
        $data = StudentGroup::whereHas('group', function ($query) use ($roomId, $studentId) {
            $query->where('room_id', $roomId)
                ->where('student_id', $studentId);
        })
        ->with(['group', 'group.discussion'])
        ->get();

            if($data){
                return ResponseFormatter::success(
                    $data,
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
