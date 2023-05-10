<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRoomRequest;
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
        return view('dashboard.room.index',[
            'rooms' => Room::where('user_id', auth()->user()->id)->get()
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
            'description' => '',
        ]);

        while(Room::where('code', '=', $code)->exists()){
            $code =  Str::random(6);
        }
        
        $validateData['code'] = $code;
        $validateData['user_id'] = auth()->user()->id;
  
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
        //
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
            'description' => '',
        ];

        if($request->slug != $room->slug){
            $rules['slug'] = 'required|unique:rooms';
        }

        $validateData =$request->validate($rules);

        $validateData['user_id'] = auth()->user()->id;

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
}
