<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Resources\TeacherCoursesResource;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    public function indexByTeacher(Teacher $teacher)
    {
        return TeacherCoursesResource::collection($teacher->courses);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string',
            'start' => 'required|string',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $course->update($request->all());

        return response()->json(['id' => $course->id], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'start' => 'required|string',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $course = Course::create($request->all());

        return response()->json(["id" => $course->id], 201);
    }

    public function destroy(Course $course)
    {
        $id = $course->id;
        $course->delete();

        return response()->json(null, 204);
    }
}
