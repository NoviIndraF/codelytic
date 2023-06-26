<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Materi;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materis = DB::table('materis')
        ->join('rooms', 'rooms.id', '=', 'materis.room_id')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select(
            'materis.*', 
            'rooms.name')
        ->get();
        return view('dashboard.materi.index',[
            'materis' => $materis,
            'count_materi' => count($materis),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = DB::table('rooms')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('rooms.*')
        ->get();

        return view('dashboard.materi.create',[
            'rooms' => $rooms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:rooms',
            'room_id' => 'required',
            'description' => 'max:255',
        ]);
        $validateData['status'] = 0;
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }
        Materi::create($validateData);

        return redirect('dashboard/materis')->with('success', 'Materi: '.$validateData['title'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        return view('dashboard.materi.show',[
            'materi' => $materi,
            'chapters' => Chapter::where('materi_id', $materi->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        return view('dashboard.materi.edit', [
            'materi' => $materi,
            'rooms' => Room::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        $rules = [
            'title' => 'required|max:255',
            'room_id' => 'required',
            'status' => 'required',
            'description' => 'max:255',
        ];

        if($request->slug != $materi->slug){
            $rules['slug'] = 'required|unique:materis';
        }

        $validateData =$request->validate($rules);
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Materi::where('id', $materi->id)->update($validateData);

        return redirect('dashboard/materis')->with('success', 'Data Kelas: '.$materi->title.' telah diperbarui');
    }

    
    public function updateStatus(Request $request)
    {
        $materi = DB::table('materis')
        ->where('id', '=', $request->materi_id)->first();
        $status = $materi->status;
        if($status == 0){
            $status = 1;
        } else {
            $status = 0;
        }
        Materi::where('id', $materi->id)->update(['status' => $status]);

        $sstatus='';
        if($status == 0){
            $sstatus= 'Nonaktif';
        } else {
            $sstatus= 'Aktif';
        }

        return redirect('dashboard/materis')->with('success', 'Materi : '.$materi->title.' telah '.$sstatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        Materi::destroy($materi->id);

        return redirect('/dashboard/materis')->with('success', 'Data Materi: '.$materi->title.' telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Materi::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    // API

    public function getMateriByRoomId(Request $request){
        $room_id = $request->room_id;
        $materi = Room::where('id',$room_id)
        ->with(['materi' => function ($query) {
            $query->where('status', 1);
        }])
        ->first();

        if($materi){
            return ResponseFormatter::success(
                $materi,
                'Data Materi Room berhasil dipanggil'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Materi Room Student tidak ada',
                404
            );
        }
    }
}
