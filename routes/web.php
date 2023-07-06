<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentGroupCommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
use App\Models\StudentGroupComment;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingpage.index');
});





Route::get('/dashboard/chapters/checkSlug', [ChapterController::class, 'checkSlug'])->middleware('auth');
Route::post('upload', [ChapterController::class, 'upload'])->name('ckeditor.upload')->middleware('auth');
Route::resource('/dashboard/chapters', ChapterController::class)->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/discussions/checkSlug', [DiscussionController::class, 'checkSlug'])->middleware('auth');
Route::post('/dashboard/discussions/showContent', [DiscussionController::class, 'showContent'])->middleware('auth');
Route::post('/dashboard/discussions/updateStatus', [DiscussionController::class, 'updateStatus'])->middleware('auth');
Route::resource('/dashboard/discussions', DiscussionController::class)->middleware('auth');

Route::get('/dashboard/groups/checkSlug', [GroupController::class, 'checkSlug'])->middleware('auth');
Route::post('/dashboard/groups/showComment', [GroupController::class, 'showComment'])->middleware('auth');
Route::resource('/dashboard/groups', GroupController::class)->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard/materis/checkSlug', [MateriController::class, 'checkSlug'])->middleware('auth');
Route::post('/dashboard/materis/updateStatus', [MateriController::class, 'updateStatus'])->middleware('auth');
Route::resource('/dashboard/materis', MateriController::class)->middleware('auth');

Route::get('/dashboard/questions/checkSlug', [QuestionController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/questions', QuestionController::class)->middleware('auth');

Route::get('/dashboard/quizzes/checkSlug', [QuizController::class, 'checkSlug'])->middleware('auth');
Route::post('/dashboard/quizzes/updateStatus', [QuizController::class, 'updateStatus'])->middleware('auth');
Route::post('/dashboard/quizzes/showStudentQuiz', [QuizController::class, 'showStudentQuiz'])->middleware('auth');
Route::post('/dashboard/quizzes/showStudentDetailQuiz', [QuizController::class, 'showStudentDetailQuiz'])->middleware('auth');
Route::resource('/dashboard/quizzes', QuizController::class)->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard/rooms/checkSlug', [RoomController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/rooms', RoomController::class)->middleware('auth');

Route::resource('/dashboard/studentGroupComments', StudentGroupCommentController::class)->middleware('auth');
Route::post('/dashboard/studentGroupComments/updateHide', [StudentGroupCommentController::class, 'updateHide'])->middleware('auth');

Route::get('/dashboard/tasks/checkSlug', [TaskController::class, 'checkSlug'])->middleware('auth');
Route::post('/dashboard/tasks/updateStatus', [TaskController::class, 'updateStatus'])->middleware('auth');
Route::post('/dashboard/tasks/show_content', [TaskController::class, 'showContent'])->middleware('auth');
Route::resource('/dashboard/tasks', TaskController::class)->middleware('auth');

Route::get('/dashboard/test', [TestController::class, 'index'])->middleware('auth');