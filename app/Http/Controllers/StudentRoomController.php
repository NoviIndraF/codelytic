<?php

namespace App\Http\Controllers;

use App\Models\StudentRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;

class StudentRoomController extends Controller
{
    public function getAllData()
    {
        $data = Room::with(['materi'])->where('code','pHOLOZ')->get();

        if($data){
            return ResponseFormatter::success(
                $data,
                'Data produk berhasil dipanggil'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data produk tidak ada',
                404
            );
        }

        return ResponseFormatter::success(
            $data,
            'Data produk berhasil diambil'
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
        //
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
