<?php

namespace App\Http\Controllers;

use App\Course;
use App\ExamCode;
use App\ExamMark;
use App\Hostel;
use App\Student;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsPageController extends Controller
{
    public function index()
    {
        if (auth::guest())
        {
            $hostel_owners = User::where('is_hostel_owner', true)->get();
            $hostels = Hostel::orderBy('rem_rooms', 'desc')->take(4)->get();
            $students = Student::all();
            $courses = Course::all();
            $examCodes = ExamCode::all();
            return view('studentspage.index', compact('hostels', 'hostel_owners', 'students', 'courses',
                'examCodes'));
        }
        else
        {
            if (auth()->user()->is_student)
            {
                $hostel_owners = User::where('is_hostel_owner', true)->get();
                $hostels = Hostel::orderBy('rem_rooms', 'desc')->take(4)->get();
                $students = Student::all();
                $courses = Course::all();
                $examCodes = ExamCode::all();
                $marks = ExamMark::where('user_id', '=' ,auth()->user()->id)->get();
                $units = Unit::all();
                return view('studentspage.index', compact('hostels', 'hostel_owners', 'students', 'courses',
                    'examCodes', 'marks', 'units'));
            }
            else
            {
                $hostel_owners = User::where('is_hostel_owner', true)->get();
                $hostels = Hostel::orderBy('rem_rooms', 'desc')->take(4)->get();
                $students = Student::all();
                $courses = Course::all();
                $examCodes = ExamCode::all();
                return view('studentspage.index', compact('hostels', 'hostel_owners', 'students', 'courses',
                    'examCodes'));
            }
        }

    }
}
