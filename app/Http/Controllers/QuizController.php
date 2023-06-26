<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Room;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = DB::table('quizzes')
        ->join('rooms', 'rooms.id', '=', 'quizzes.room_id')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select(
            'quizzes.*', 
            'rooms.name')
        ->get();
        return view('dashboard.quiz.index',[
            'quizzes' => $quizzes,
            'count_quiz' => count($quizzes),
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

        return view('dashboard.quiz.create',[
            'rooms' => $rooms
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuizRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:rooms',
            'room_id' => 'required',
            'level' => 'required',
            'description' => 'max:255',
        ]);
        $validateData['status'] = 0;
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }
        
        Quiz::create($validateData);

        return redirect('dashboard/quizzes')->with('success', 'Kuis : '.$validateData['title'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        return view('dashboard.quiz.show',[
            'quiz' => $quiz,
            'questions' => Question::where('quiz_id', $quiz->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('dashboard.quiz.edit', [
            'quiz' => $quiz,
            'rooms' => Room::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuizRequest  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $rules = [
            'title' => 'required|max:255',
            'level' => 'required',
            'room_id' => 'required',
            'status' => 'required',
            'description' => 'max:255',
        ];

        if($request->slug != $quiz->slug){
            $rules['slug'] = 'required|unique:quizzes';
        }

        $validateData =$request->validate($rules);
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Quiz::where('id', $quiz->id)->update($validateData);

        return redirect('dashboard/quizzes')->with('success', 'Data Kuis: '.$quiz->title.' telah diperbarui');
    }

    public function updateStatus(Request $request)
    {
        $quiz = DB::table('quizzes')
        ->where('id', '=', $request->id)->first();
        
        $status = $quiz->status;
        if($status == 0){
            $status = 1;
        } else {
            $status = 0;
        }

        Quiz::where('id', $quiz->id)->update(['status' => $status]);

        $sstatus='';
        if($status == 0){
            $sstatus= 'Nonaktif';
        } else {
            $sstatus= 'Aktif';
        }

        return redirect('dashboard/quizzes')->with('success', 'Materi : '.$quiz->title.' telah '.$sstatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        Quiz::destroy($quiz->id);
        return redirect('/dashboard/quizzes')->with('success', 'Data Kuiz: '.$quiz->title.' telah dihapus!');

    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Quiz::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    // API
    public function getQuizByRoomId(Request $request){
        $room_id = $request->room_id;
        $quiz = Room::where('id',$room_id)
        ->with(['quiz' => function ($query) {
            $query->where('status', 1)
            ->with('question');
        }])
        ->first();

        if($quiz){
            return ResponseFormatter::success(
                $quiz,
                'Data Kuis Room berhasil dapatkan'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Kuiz Room Student tidak ada',
                404
            );
        }
    }

    public function getQuizzesByLevelAndRoomId(Request $request){
    $level = $request->level;
    $roomId= $request->room_id;
        $quizzes = Quiz::where('level', $level)
        ->where('status', 1)
        ->where('room_id', $roomId)
        ->with('question')
        ->get();

    if($quizzes){
        return ResponseFormatter::success(
            $quizzes,
            'Data Kuis Room berhasil dapatkan'
        );
    } else{
        return ResponseFormatter::success(
            null,
            'Data Kuis Room Student tidak ada',
            404
        );
    }
}
}
