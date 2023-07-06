<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Discussion;
use App\Models\Group;
use App\Models\Room;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discussions = Discussion::with('room.user')
        ->whereHas('room.user', function ($query) {
            $query->where('id', auth()->user()->id);
        })
        ->with('group.student_group')
        ->get();
        return view('dashboard.discussion.index',[
            'discussions' => $discussions,
            'count_discussions' => count($discussions),
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

        return view('dashboard.discussion.create',[
            'rooms' => $rooms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiscussionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:discussions',
            'room_id' => 'required',
            'editor' => 'required',
            'description' => 'max:255',
        ]);
        $validateData['status'] = 0;
        $validateData = array_replace($validateData, ['content' => $validateData['editor']]);
        unset($validateData['editor']);
        
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Discussion::create($validateData);

        return redirect('dashboard/discussions')->with('success', 'Diskusi: '.$validateData['title'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        return view('dashboard.discussion.show',[
            'discussion' => $discussion,
            'groups' => Group::where('discussion_id', $discussion->id)->get()
        ]);
    }

    public function showContent(Request $request)
    {
        return view('dashboard.discussion.show_content', [
            'content' => $request->content
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        return view('dashboard.discussion.edit', [
            'discussion' => $discussion,
            'rooms' => Room::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscussionRequest  $request
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        $rules = [
            'title' => 'required|max:255',
            'slug' => 'required',
            'editor' => 'required',
            'description' => 'max:255',
            'room_id' => 'required',
        ];

        if($request->slug != $discussion->slug){
            $rules['slug'] = 'required|unique:discussions';
        }

        $validateData =$request->validate($rules);
        $validateData = array_replace($validateData, ['content' => $validateData['editor']]);
        unset($validateData['editor']);
        
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Discussion::where('id', $discussion->id)->update($validateData);

        return redirect('dashboard/discussions')->with('success', 'Data Diskusi: '.$discussion->title.' telah diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discussion $discussion)
    {
        Discussion::destroy($discussion->id);
        return redirect('dashboard/discussions/')->with('success', 'Data Diskusi: '.$discussion->title.' telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Discussion::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function updateStatus(Request $request)
    {
        $discussion = DB::table('discussions')
        ->where('id', '=', $request->id)->first();
        
        $status = $discussion->status;
        if($status == 0){
            $status = 1;
        } else {
            $status = 0;
        }

        Discussion::where('id', $discussion->id)->update(['status' => $status]);

        $sstatus='';
        if($status == 0){
            $sstatus= 'Nonaktif';
        } else {
            $sstatus= 'Aktif';
        }

        return redirect('dashboard/discussions')->with('success', 'Materi : '.$discussion->title.' telah '.$sstatus);
    }

    // API
    public function showDiscussion(Request $request)
    {
        $content = $request->content;
        return view('api.discussion.show', [
            'content' => $content
        ]);
    }
}
