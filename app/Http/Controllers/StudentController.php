<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json(StudentResource::collection($students));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        // if(!Auth::user()->is_admin) {
        //     return response()->json(['message' => 'You are not authorized to create a student!']);
        // }

        /** @var user $user **/
        $user = Auth::user();
        if($user->cannot('create', Student::class)) {
            return response()->json(['message' => 'You are not authorized to create new student!'], 403);
        }

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $student = Student::create($validated);
        return response()->json(new StudentResource($student));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json(new StudentResource($student));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        /** @var user $user **/
        $user = Auth::user();
        if($user->cannot('update', $student)) {
            return response()->json(['message' => 'You are not authorized to update a student!'], 403);
        }

        $validated = $request->validated();
        $student->update($validated);
        return response()->json(new StudentResource($student));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        /** @var user $user **/
        $user = Auth::user();
        if($user->cannot('delete', $student)) {
            return response()->json(['message' => 'You are not authorized to delete this student!'], 403);
        }
        $student->delete();
        return response()->noContent();
    }
}
