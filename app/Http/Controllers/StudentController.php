<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use Illuminate\Support\Facades\DB;
use App\Models\ExamAttemptQuestion;
use App\Models\ExamQuestion;
use App\Models\LessonUser;
use App\Models\StudentNotification;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'edit' => 'Edit Form',
        'studentProfile' => 'Student Profile',
        'checkout' => 'Checkout',
        'explanation' => 'Explanation',
        'studentCourse' => 'Student Course',
        'studentCourseDetails' => 'Student Course Details',
        'studentVideoLessonDetails' => 'Student Video Lesson Details',
    ];

    public function index()
    {
        return view('backend.students.index');
    }

    public function create()
    {
        return view('backend.students.create');
    }

    public function studentProfile()
    {
        $user = auth()->user();
        return view('backend.students.profile', compact('user'));
    }

    public function checkout()
    {
        return view('backend.students.checkout');
    }

    // public function explanation($examAttemptId, $questionId = null)
    // {
    //     $examAttempt = ExamAttempt::with(['exam.questions', 'exam.sections'])->findOrFail($examAttemptId);
    //     $exam = $examAttempt->exam;
    //     $userId = Auth::id();

    //     if ($examAttempt->user_id !== $userId) {
    //         abort(403, 'Unauthorized access to exam attempt.');
    //     }

    //     // Fetch all questions with their attempt details
    //     $questions = $exam->questions->map(function ($question) use ($examAttempt) {
    //         $attemptQuestion = ExamAttemptQuestion::where('attempt_id', $examAttempt->id)
    //             ->where('question_id', $question->id)
    //             ->first();

    //         return [
    //             'id' => $question->id,
    //             'question_title' => $question->question_title,
    //             'question_description' => $question->question_description,
    //             'options' => $question->options,
    //             'correct_answer' => $question->correct_answer,
    //             'explanation' => $question->explanation,
    //             'sat_question_type' => $question->sat_question_type,
    //             'difficulty' => $question->difficulty,
    //             'is_correct' => $attemptQuestion ? $attemptQuestion->is_correct : false,
    //             'time_spent' => $attemptQuestion ? $attemptQuestion->time_spent : 0,
    //             'student_answer' => $attemptQuestion ? $attemptQuestion->student_answer : null,
    //             'section' => $examAttempt->exam?->section
    //         ];
    //     })->groupBy('sat_question_type');

    //     $flatQuestions = $questions->flatten(1)->values();

    //     $metadata = [
    //         'exam_name' => $exam->name,
    //         'total_questions' => $exam->questions->count(),
    //         'total_duration' => $exam->duration,
    //         'scheduled_at' => $exam->scheduled_at,
    //     ];

    //     return view('backend.students.explanation', compact('exam', 'questions', 'examAttempt', 'flatQuestions', 'questionId'));
    // }

    public function explanation($examAttemptId, $questionId = null)
    {
        $userId = Auth::id();

        $examAttempt = ExamAttempt::where('user_id', $userId)->with('exam.sections')->findOrFail($examAttemptId);
        $exam = $examAttempt->exam;

        $question = ExamQuestion::findOrFail($questionId);
        $studentAnswer = $examAttempt->examAttemptQuestions->where('question_id', $questionId)->first()->student_answer;
        $answer = $question->correct_answer == $studentAnswer ? 'correct' : 'wrong';

        return view('backend.students.explanation', compact('exam', 'question', 'examAttempt', 'answer', 'studentAnswer'));
    }

    public function studentCourse()
    {
        $user = auth()->user();

        // 1. All courses from the database (not only enrolled ones)
        $allCourses = Course::latest()->get();

        // 2. Courses completed by the user
        $completeCourses = Course::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('is_completed', true);
        })->latest()->get();

        // 3. Courses incomplete for the user
        $incompleteCourses = Course::where(function ($query) use ($user) {
            // Courses where user has not completed OR has no record
            $query->whereHas('users', function ($q) use ($user) {
                $q->where('user_id', $user->id)
                ->where(function ($q2) {
                    $q2->where('is_completed', false)->orWhereNull('is_completed');
                });
            })
            ->orWhereDoesntHave('users', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->latest()->get();
        $lessons = Lesson::where('file_type', 'Video')->latest()->get();
        return view('backend.students.student_course', compact('allCourses', 'lessons', 'completeCourses', 'incompleteCourses'));
    }

    public function studentCourseDetails($id)
    {
        $course = Course::findOrFail($id);
        $user = Auth::user(); // Get the authenticated user

        $chapterLessons = DB::table('chapter_lesson')
            ->where('course_id', $course->id)
            ->join('chapters', 'chapter_lesson.chapter_id', '=', 'chapters.id')
            ->join('lessons', 'chapter_lesson.lesson_id', '=', 'lessons.id')
            ->select(
                'chapters.id as chapter_id',
                'chapters.title as chapter_title',
                'lessons.id as lesson_id',
                'lessons.file_path as file_path',
                'lessons.file_name',
                'lessons.file_type',
                'lessons.total_length',
                'lessons.title'
            )
            ->get();

        $groupedChapters = $chapterLessons->groupBy('chapter_title')->map(function ($items, $chapterTitle) use ($user, $course) {
            $first = $items->first();
            return [
                'id' => $first->chapter_id,
                'title' => $chapterTitle,
                'index' => null, // Optionally assign an index like "Chapter 1"
                'duration' => '00:00', // You can calculate actual duration here
                'lessonsCount' => count($items),
                'expanded' => false,
                'lessons' => $items->map(function ($lesson) use ($user, $course, $first) {
                    // Check if the lesson is completed by the user
                    $lessonUser = LessonUser::where('user_id', $user->id)
                        ->where('lesson_id', $lesson->lesson_id)
                        ->where('course_id', $course->id)
                        ->where('chapter_id', $first->chapter_id)
                        ->first();

                    return [
                        'id' => $lesson->lesson_id,
                        'name' => $lesson->title,
                        'path' => $lesson->file_path,
                        'type' => strtolower($lesson->file_type),
                        'duration' => $lesson->total_length,
                        'completed' => $lessonUser ? (bool) $lessonUser->completed_at : false,
                        'progress' => $lessonUser && $lessonUser->completed_at ? 100 : ($lessonUser->progress ?? 0)
                    ];
                })->toArray()
            ];
        })->values();

        if(!is_null($course->exam_id))
        {
            $exam = Exam::find($course->exam_id);
        } else {
            $exam = null;
        }

        return view('backend.students.student_course_details', compact('course', 'chapterLessons', 'groupedChapters', 'exam'));
    }

    public function studentVideoLessonDetails($uuid)
    {
        $lesson = Lesson::where('uuid', $uuid)->first();

        $relatedLessons = Lesson::where('audience', $lesson->audience)
            ->where('file_type', 'Video')
            ->where('question_type', $lesson->question_type)
            ->where('id', '!=', $lesson->id)
            ->inRandomOrder()
            ->get();

        return view('backend.students.student_video_lesson_details', compact('lesson', 'relatedLessons'));
    }
}
