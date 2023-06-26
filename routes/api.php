<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentQuizController;
use App\Http\Controllers\StudentRoomController;
use App\Http\Controllers\StudentTaskController;
use App\Http\Controllers\TaskController;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [StudentController::class, 'login']);
Route::post('register', [StudentController::class, 'register']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group( function() {
    Route::post('createStudentRoom', [StudentRoomController::class, 'store']);
    
    Route::post('getAllDataByRoomCode', [RoomController::class, 'getAllDataByRoomCode']);

    Route::post('getChapterByMateriId', [ChapterController::class, 'getChapterByMateriId']);
    Route::post('getMateriByRoomId', [MateriController::class, 'getMateriByRoomId']);
    Route::post('getTaskByRoomId', [TaskController::class, 'getTaskByRoomId']);

    Route::post('getQuizzesByLevelAndRoomId', [QuizController::class, 'getQuizzesByLevelAndRoomId']);
    Route::post('getQuizByRoomId', [QuizController::class, 'getQuizByRoomId']);

    Route::post('getRoomById', [RoomController::class, 'getRoomById']);
    Route::post('getRoomByCode', [RoomController::class, 'getRoomByCode']);
    
    Route::post('getStudent', [StudentController::class, 'getStudent']);
    Route::post('getStudentQuizById', [StudentQuizController::class, 'getStudentQuizById']);
    Route::post('getStudentQuizByRoomId', [StudentQuizController::class, 'getStudentQuizByRoomId']);
    Route::post('getStudentRoom', [StudentRoomController::class, 'getStudentRoom']);
    Route::post('getStudentTask', [StudentTaskController::class, 'getStudentTask']);
    Route::post('getStudentTaskByRoomId', [StudentTaskController::class, 'getStudentTaskByRoomId']);

    Route::post('logout', [StudentController::class, 'logout']);
    
    Route::post('submitQuiz', [StudentQuizController::class, 'store']);
    Route::post('submitTask', [StudentTaskController::class, 'store']);
});


Route::post('showChapter', [ChapterController::class, 'showChapter']);
Route::post('showQuestion', [QuestionController::class, 'showQuestion']);
Route::post('showTask', [TaskController::class, 'showTask']);