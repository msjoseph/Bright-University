<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use App\AdminTodo;
use App\Student;
use App\Course;
use App\AcademicYear;
use App\Semester;

class DashBoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $year = AcademicYear::all();
        $semester = Semester::all();
        $tasks = AdminTodo::where('user_id', '=', auth()->user()->id)->get();
        $tasksCount = $tasks->count();
        $students = Student::orderBy('adm_num', 'asc')->paginate(20);
        $courses = Course::all();
        return view('AdminDashboard.AdminDashboard', compact('tasks', 'tasksCount', 'students',
            'courses', 'year', 'semester'));
    }

}
