<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Question;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class QuestionController extends Controller
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
        return view('dashboard.question.create', ['quiz' => $request->quiz_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:questions',
            'description' => '',
            'note' => 'required|max:255',
            'editor' => 'required',
            'answer_correct' => 'required|max:255',
            'quiz_id' => 'required',
        ]);

        $validateData['content'] = $validateData['editor'];
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }
        
        Question::create($validateData);
        
        $quiz = DB::table('quizzes')
        ->where('id', $request->quiz_id)
        ->select(
            'quizzes.slug as quiz_slug',)
        ->first();
        return redirect('dashboard/quizzes/'.$quiz->quiz_slug)->with('success', 'Pertanyaan Kuis: '.$validateData['title'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('dashboard.question.show', [
            'content' => $question->content
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('dashboard.question.edit', [
            'question' => $question,
            'quiz_id' => $question->quiz_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'editor' => 'required',
            'answer_correct' => 'required|max:255',
            'note' => 'required|max:255',
            'quiz_id' => 'required',
        ];
    
        if($request->slug != $question->slug){
            $rules['slug'] = 'required|unique:questions';
        }

        $validateData =$request->validate($rules);

        $validateData = array_replace($validateData, ['content' => $validateData['editor']]);
        unset($validateData['editor']);
        
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Question::where('id', $question->id)->update($validateData);

        $quiz = DB::table('quizzes')
        ->where('id', $request->quiz_id)
        ->select(
            'quizzes.slug as quiz_slug',)
        ->first();
        return redirect('dashboard/quizzes/'.$quiz->quiz_slug)->with('success', 'Data Pertanyaan Kuis: '.$question->title.' telah diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        Question::destroy($question->id);

        $quiz = DB::table('quizzes')
        ->where('id', $question->quiz_id)
        ->select(
            'quizzes.slug as quiz_slug',)
        ->first();
        return redirect('dashboard/quizzes/'.$quiz->quiz_slug)->with('success', 'Data Pertanyaan: '.$question->title.' telah dihapus!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Question::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    // API
    public function showQuestion(Request $request)
    {
        $content = $request->content;
        return view('api.chapter.show', [
            'content' => $content
        ]);
    }
}
