<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Discussion;
use App\Models\Group;
use App\Models\StudentGroup;
use App\Models\StudentGroupComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
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
    public function create(Request $request)
    {
        return view('dashboard.group.create', ['discussion' => $request->discussion_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code =  Str::random(6);

        $validateData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:rooms',
            'description' => 'max:255',
            'discussion_id' => 'required',
        ]);

        while(Group::where('code', '=', $code)->exists()){
            $code =  Str::random(6);
        }
        
        $validateData['code'] = $code;
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Group::create($validateData);
        
        $discussion = DB::table('discussions')
        ->where('id', $request->discussion_id)
        ->select(
            'discussions.slug as discussion_slug',)
        ->first();

        return redirect('dashboard/discussions/'.$discussion->discussion_slug)->with('success', 'Kelompok Diskusi: '.$validateData['name'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $group = Group::where('id', $group->id)
        ->with('student_group.student')
        ->first();
        return view('dashboard.group.show',[
            'group' => $group,
            'studentGroup' => $group->student_group,
        ]);
    }

    public static function showComment(Request $request)
    {
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    { 
        return view('dashboard.group.edit', [
            'group' => $group,
            'discussion_id' => $group->discussion_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => '',
            'discussion_id' => 'required',
        ];
    
       

        if($request->slug != $group->slug){
            $rules['slug'] = 'required|unique:chapters';
        }

        $validateData =$request->validate($rules);
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Group::where('id', $group->id)->update($validateData);

        $discussion = DB::table('discussions')
        ->where('id', $request->discussion_id)
        ->select(
            'discussions.slug as discussion_slug',)
        ->first();
        return redirect('dashboard/discussions/'.$discussion->discussion_slug)->with('success', 'Data Kelompok Diskusi: '.$group->name.' telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        Group::destroy($group->id);

        $discussion = DB::table('discussions')
        ->where('id', $group->discussion_id)
        ->select(
            'discussions.slug as discussion_slug',)
        ->first();
        return redirect('dashboard/discussions/'.$discussion->discussion_slug)->with('success', 'Data Kelompok Diskusi: '.$group->name.' telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Group::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    // API

    public function getGroupByCode(Request $request){
        $code = $request->code;
        $group = Group::where('code', $code)->with('discussion')->first();

        if($group){
            return ResponseFormatter::success(
                $group,
                'Data Diskusi Grup berhasil dipanggil'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Diskusi Grup Student tidak ada',
                404
            );
        }
    }
}
