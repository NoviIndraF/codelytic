<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Materi;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Messages;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.chapter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dashboard.chapter.create', ['materi' => $request->materi_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreChapterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:chapters',
            'description' => '',
            'index' => 'required',
            'content' => 'required',
            'materi_id' => 'required',
        ]);
        
        Chapter::create($validateData);
        
        $materi = DB::table('materis')
        ->where('id', $request->materi_id)
        ->select(
            'materis.slug as materi_slug',)
        ->first();
        return redirect('dashboard/materis/'.$materi->materi_slug)->with('success', 'Konten Materi: '.$validateData['title'].' telah ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function show(Chapter $chapter)
    {
        return view('dashboard.chapter.show', [
            'content' => $chapter->content
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChapterRequest  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chapter $chapter)
    {
        Chapter::destroy($chapter->id);

        $materi = DB::table('materis')
        ->where('id', $chapter->materi_id)
        ->select(
            'materis.slug as materi_slug',)
        ->first();
        return redirect('dashboard/materis/'.$materi->materi_slug)->with('success', 'Data Materi: '.$chapter->title.' telah dihapus!');
    }

    /** 
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     * 
     **/  
     
     public function upload(Request $request)
     {
        $data = array();
         $validator = Validator::make($request->all(), [
              'upload' => 'required|mimes:png,jpg,jpeg|max:2048'
         ]);
         if ($validator->fails()) {
              $data['uploaded'] = 0;
              $data['error']['message'] = $validator->errors()->first('upload');// Error response
         }else{
              if($request->file('upload')) {
                    $file = $request->file('upload');
                    $filename = time().'_'.$file->getClientOriginalName();
                    // File upload location
                    $location = 'uploads';
                    // Upload file
                    $file->move($location,$filename);
                    // File path
                    $filepath = url('uploads/'.$filename);
                    // Response
                    $data['fileName'] = $filename;
                    $data['uploaded'] = 1;
                    $data['url'] = $filepath;
              }else{
                    // Response
                    $data['uploaded'] = 0;
                    $data['error']['message'] = 'File not uploaded.'; 
              }
         }
         return response()->json($data);
        }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Chapter::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
