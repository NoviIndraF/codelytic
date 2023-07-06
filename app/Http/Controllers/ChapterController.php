<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Chapter;
use App\Models\Materi;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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
            'editor' => 'required',
            'materi_id' => 'required',
        ]);

        $index = DB::table('chapters')
                ->select('index')
                ->where('materi_id', 'LIKE', $validateData['materi_id'])
                ->where('index', 'LIKE', $validateData['index'])
                ->get();
                
        if(!$index->isEmpty()){
            throw ValidationException::withMessages(['index' => ['Index has been exists'],]);
        }

        $validateData['content'] = $validateData['editor'];
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }
        
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
        return view('dashboard.chapter.edit', [
            'chapter' => $chapter,
            'materi_id' => $chapter->materi_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChapterRequest  $request
     * @param  \App\Models\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chapter $chapter)
    {
        
        $rules = [
            'title' => 'required|max:255',
            'description' => '',
            'index' => 'required',
            'editor' => 'required',
            'materi_id' => 'required',
        ];
    
       

        if($request->slug != $chapter->slug){
            $rules['slug'] = 'required|unique:chapters';
        }

        $validateData =$request->validate($rules);
        
        if($request->index != $chapter->index && Chapter::where('index', '=', $validateData['index'])->exists()){
            throw ValidationException::withMessages(['index' => ['Index has been exists'],]);
        }

        $validateData = array_replace($validateData, ['content' => $validateData['editor']]);
        unset($validateData['editor']);
        $description = $validateData['description'];
        if(is_null($description)){
            $validateData['description'] = '';
        }

        Chapter::where('id', $chapter->id)->update($validateData);

        $materi = DB::table('materis')
        ->where('id', $request->materi_id)
        ->select(
            'materis.slug as materi_slug',)
        ->first();
        return redirect('dashboard/materis/'.$materi->materi_slug)->with('success', 'Data Konten Materi: '.$chapter->title.' telah diperbarui');
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
              'upload' => 'required|mimes:png,jpg,jpeg|max:1024'
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

    // API
    public function getChapterByMateriId(Request $request){
        $materi_id = $request->materi_id;
        $materi = Materi::where('id', $materi_id)
        ->with('chapter' )
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

    public function showChapter(Request $request)
    {
        $content = $request->content;
        return view('api.chapter.show', [
            'content' => $content
        ]);
    }
}
