<?php

namespace App\Http\Controllers;

use App\ExamMark;
use App\Lecturer;
use App\School;
use App\Student;
use App\Unit;
use App\User;
use Illuminate\Http\Request;

class SubmitMarksController extends Controller
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
     * Show the view to submit units.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $submittedUnits = ExamMark::all();
        $units = Unit::all();
        $lecturers = Lecturer::all();
        $users = User::all();
        $students = Student::all();
        $schools = School::all();
        return view('unitsReg.submitMarks', compact('submittedUnits', 'units', 'lecturers', 'users',
            'students', 'schools'));
    }
}
