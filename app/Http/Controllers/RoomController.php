<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Materi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\StudentRoom;
use Cviebrock\EloquentSluggable\Services\SlugService;

class RoomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::where('user_id', auth()->user()->id)->with('student_room')->get();
        return view('dashboard.room.index',[
            'rooms' => $rooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code =  Str::random(6);

        $validateData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:rooms',
            'major' => 'required|max:255',
            'description' => 'max:255',
        ]);

        while(Room::where('code', '=', $code)->exists()){
            $code =  Str::random(6);
        }
        
        $validateData['code'] = $code;
        $validateData['user_id'] = auth()->user()->id;
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Room::create($validateData);

        return redirect('dashboard/rooms')->with('success', 'Data Kelas: '.$validateData['name'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $room = Room::where('id', $room->id)
        ->where('user_id', auth()->user()->id)
        ->with('student_room.student')->first();
        return view('dashboard.room.show',[
            'room' => $room,
            'studentsRoom'=> $room->student_room
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('dashboard.room.edit', [
            'room' => $room
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $rules = [
            'name' => 'required|max:255',
            'major' => 'required|max:255',
            'description' => 'max:255',
        ];

        if($request->slug != $room->slug){
            $rules['slug'] = 'required|unique:rooms';
        }

        $validateData =$request->validate($rules);
        $validateData['user_id'] = auth()->user()->id;
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Room::where('id', $room->id)->update($validateData);

        return redirect('dashboard/rooms')->with('success', 'Data Kelas: '.$room->name.' telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        Room::destroy($room->id);

        return redirect('/dashboard/rooms')->with('success', 'Data Kelas: '.$room->name.' telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Room::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    // API
    public function getRoomByCode(Request $request){
        $code = $request->code;
        $room = Room::where('code',$code)->first();

        if($room){
            return ResponseFormatter::success(
                $room,
                'Data Room berhasil dipanggil'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Room tidak ada',
                404
            );
        }
    }

    public function getRoomById(Request $request){
        $room_id = $request->room_id;
        $room = Room::find($room_id);

        if($room){
            return ResponseFormatter::success(
                $room,
                'Data Room berhasil dipanggil'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Room tidak ada',
                404
            );
        }
    }
}
