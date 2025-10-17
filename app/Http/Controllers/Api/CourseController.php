<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCard;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
   public function index()
    {
        $courses = CourseCard::with(['category', 'content'])->get();
        return response()->json(['courses' => $courses]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_category' => 'required|exists:category,id_category',
            'name' => 'required|string|max:255',
            'course_by' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            // Course content fields (optional)
            'perakitan' => 'nullable|string',
            'worksheet' => 'nullable|string',
            'ebook' => 'nullable|string',
            'live_session' => 'nullable|string',
            'mini_competition' => 'nullable|string',
            'level' => 'nullable|in:beginner,intermediate,advanced',
            'validity' => 'nullable|integer',
            'certificate' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $course = CourseCard::create([
                'id_category' => $request->id_category,
                'name' => $request->name,
                'course_by' => $request->course_by,
                'price' => $request->price,
            ]);

            // Create course content if provided
            if ($request->has(['perakitan', 'worksheet', 'ebook'])) {
                CourseContent::create([
                    'id_course' => $course->id_course,
                    'id_category' => $request->id_category,
                    'perakitan' => $request->perakitan,
                    'worksheet' => $request->worksheet,
                    'ebook' => $request->ebook,
                    'live_session' => $request->live_session,
                    'mini_competition' => $request->mini_competition,
                    'level' => $request->level ?? 'beginner',
                    'validity' => $request->validity ?? 365,
                    'certificate' => $request->certificate ?? false,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Course berhasil dibuat',
                'course' => $course->load('content')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $course = CourseCard::with(['category', 'content'])->find($id);

        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }

        return response()->json(['course' => $course]);
    }

    public function update(Request $request, $id)
    {
        $course = CourseCard::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_category' => 'exists:category,id_category',
            'name' => 'string|max:255',
            'course_by' => 'nullable|string|max:255',
            'price' => 'numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course->update($request->only(['id_category', 'name', 'course_by', 'price']));

        return response()->json([
            'message' => 'Course berhasil diupdate',
            'course' => $course->load('content')
        ]);
    }

    public function destroy($id)
    {
        $course = CourseCard::find($id);

        if (!$course) {
            return response()->json(['message' => 'Course tidak ditemukan'], 404);
        }

        $course->delete();

        return response()->json(['message' => 'Course berhasil dihapus']);
    }

    public function byCategory($categoryId)
    {
        $courses = CourseCard::where('id_category', $categoryId)
            ->with(['category', 'content'])
            ->get();

        return response()->json(['courses' => $courses]);
    }
}
