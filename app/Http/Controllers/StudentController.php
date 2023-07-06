<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       //  $data = Student::with(['student_room'])->where('id', Auth::user()->id)->get();
public function login(Request $request){
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if(!Auth::guard('students')->attempt($credentials)){
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Authentication Failed', 500);
            }

            $student = Student::where('email', $request->email)->first();
            if(!Hash::check($request->password, $student->password, [])){
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $student->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token'=> $tokenResult,
                'token_type' => 'Bearer',
                'student' => $student
            ], 'Authenticated');
        } catch (\Throwable $error) {
            return ResponseFormatter::error([
                'message'   => 'Something went error',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success($token, 'Token Revoked');
    }

    public function register(Request $request)
    {
        try {
            $request -> validate(
                [
                    'name' => ['required', 'string'],
                    'username' => ['required', 'string', 'unique:students'],
                    'email' => ['required', 'string', 'email',  'unique:students'],
                    'password' => ['required', 'string', new Password],
                    ]
                );

                Student::create([
                    'name' => $request->name,
                    'username' =>$request->username,
                    'email' => $request->email,
                    'password'=> Hash::make($request->password),
                ]);

                $student = Student::where('email', $request->email)->first();
                $tokenResult = $student->createToken('authToken')->plainTextToken;

                return ResponseFormatter::success([
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'student'=> $student
                ], 'User Registered');
        } catch (Exception $error)
        {
            return ResponseFormatter::error([
                'message' => 'Something went error',
                'error' => $error
            ], 'Aunthetantication Failed, 500');
        }
    }

    public function getStudent(Request $request){
        
        $student = Student::where('id', Auth::user()->id)->first();
        if($student){
            return ResponseFormatter::success(
                $student,
                'Data Student berhasil didapatkan'
            );
        } else{
            return ResponseFormatter::success(
                null,
                'Data Student tidak ada',
                404
            );
        }
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
