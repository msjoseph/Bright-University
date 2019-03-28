<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\ExamMark;
use App\Semester;
use Illuminate\Http\Request;
use App\RegisteredUnit;
use App\Student;
use App\Unit;
use App\Course;
use App\School;


class UnitsRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a list of all registered units.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->is_student)
        {
            $year = AcademicYear::all();
            $semester = Semester::all();
            $submittedUnits = ExamMark::where('user_id', auth()->user()->id)->get();
            $registeredUnits = RegisteredUnit::where('user_id', auth()->user()->id)->orderBy('id', 'asc')->get();
            $units = Unit::orderBy('code', 'asc')->get();
            $schools = School::all();
            $student = Student::where('user_key', auth()->user()->student_key)->get();
            $courses = Course::all();
            return view('unitsReg.index', compact('registeredUnits', 'units', 'student', 'courses',
                'schools', 'year', 'semester', 'submittedUnits'));
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
        }

    }

    /**
     * Show the form for registering units.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->is_student)
        {
            $this->validate($request, [
                'unit_id' =>'required',
                'unit_name' => 'required',
                'year' => 'required',
                'semester' => 'required',
            ]);
            $unit_id = $request->unit_id;
            $unit_name = $request->unit_name;
            $year = $request->year;
            $semester = $request->semester;

            $registeredUnits = RegisteredUnit::where('user_id', auth()->user()->id)->orderBy('id', 'asc')->get();
            foreach ($registeredUnits as $registeredUnit)
            {
                if ($registeredUnit->unit_id == $unit_id && $registeredUnit->year == $year && $registeredUnit->semester == $semester)
                {
                    return redirect('/UnitsRegistration')->with('error', 'You cannot register a unit more than once');
                }
            }

            $success_message = "$unit_id - $unit_name registered";

            $registeredUnit = new RegisteredUnit;
            $registeredUnit->unit_id = $request->unit_id;
            $registeredUnit->user_id = auth()->user()->id;
            $registeredUnit->year = $request->year;
            $registeredUnit->semester = $request->semester;
            $registeredUnit->unit_id = $request->unit_id;
            $registeredUnit->save();

            return redirect('/UnitsRegistration')->with('success', $success_message);
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (auth()->user()->is_student)
        {
            $del_unit = RegisteredUnit::where('unit_id', $id);

            $del_unit->delete();
            return redirect('/UnitsRegistration')->with('success', 'Unit de-registered');
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
        }

    }



}
