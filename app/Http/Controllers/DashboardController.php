<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $rooms = DB::table('rooms')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select('rooms.*')
        ->get();

        $materis = DB::table('materis')
        ->join('rooms', 'rooms.id', '=', 'materis.room_id')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select(
            'materis.*')
        ->get();

        $tasks = DB::table('tasks')
        ->join('rooms', 'rooms.id', '=', 'tasks.room_id')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select(
            'tasks.*')
        ->get();

        $quizzes = DB::table('quizzes')
        ->join('rooms', 'rooms.id', '=', 'quizzes.room_id')
        ->join('users', 'users.id', '=', 'rooms.user_id')
        ->where('users.id', '=', auth()->user()->id)
        ->select(
            'quizzes.*')
        ->get();

        return view('dashboard.index', [
            'count_room' => count($rooms),
            'count_materi' => count($materis),
            'count_tasks' => count($tasks),
            'count_quizzes' => count($quizzes),
        ]);
    }
}
