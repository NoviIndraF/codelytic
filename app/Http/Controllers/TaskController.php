<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = DB::table('tasks')
        ->join('rooms', 'rooms.id', '=', 'tasks.room_id')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select(
            'tasks.*', 
            'rooms.name')
        ->get();
        return view('dashboard.task.index',[
            'tasks' => $tasks
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

        return view('dashboard.task.create',[
            'rooms' => $rooms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:rooms',
            'deadline' => 'required|',
            'room_id' => 'required',
            'editor' => 'required',
            'note' => '',
            'description' => '',
        ]);
        $validateData['status'] = 0;
        $validateData = array_replace($validateData, ['content' => $validateData['editor']]);
        unset($validateData['editor']);

        Task::create($validateData);

        return redirect('dashboard/tasks')->with('success', 'Tugas: '.$validateData['title'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        $task = DB::table('tasks')
        ->where('id', '=', $request->id)->first();
        
        $status = $task->status;
        if($status == 0){
            $status = 1;
        } else {
            $status = 0;
        }

        Task::where('id', $task->id)->update(['status' => $status]);

        $sstatus='';
        if($status == 0){
            $sstatus= 'Nonaktif';
        } else {
            $sstatus= 'Aktif';
        }

        return redirect('dashboard/tasks')->with('success', 'Materi : '.$task->title.' telah '.$sstatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        Task::destroy($task->id);
        return redirect('dashboard/tasks/')->with('success', 'Data Tugas: '.$task->title.' telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Task::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
