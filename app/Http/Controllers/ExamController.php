<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Course;
use App\ExamCode;
use App\ExamMark;
use App\RegisteredUnit;
use App\School;
use App\Semester;
use App\Student;
use App\Unit;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $year = AcademicYear::all();
        $semester = Semester::all();
        $registeredUnits = RegisteredUnit::where('user_id', auth()->user()->id)->orderBy('id', 'asc')->get();
        $units = Unit::all();
        $schools = School::all();
        $student = Student::where('user_key', auth()->user()->student_key)->get();
        $courses = Course::all();
        return view('unitsReg.create', compact('registeredUnits', 'units', 'student', 'courses',
            'schools', 'year', 'semester'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'year' =>'required',
            'semester' =>'required',
            'unit_id' =>'required',
        ]);
        $unit_id =$request->unit_id;
        $year = $request->year;
        $semester = $request->semester;

        $registeredUnits = RegisteredUnit::all();
        foreach ($registeredUnits as $registeredUnit)
        {
            if ($registeredUnit->user_id == auth()->user()->id)
            {
                if ($registeredUnit->unit_id == $unit_id && $registeredUnit->year == $year && $registeredUnit->semester == $semester)
                {
                    $registeredUnit->is_submitted = true;
                    $registeredUnit->save();
                }
            }


        }


        $submitUnit = new ExamMark;
        $submitUnit->user_id = auth()->user()->id;
        $submitUnit->unit_id = $request->unit_id;
        $submitUnit->year = $request->year;
        $submitUnit->semester = $request->semester;
        $submitUnit->save();

        return redirect('/UnitsSubmission/create')->with('success', 'unit submitted');
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
        $this->validate($request, [
            'cat' =>'required',
            'exam' =>'required',
        ]);
        $submitMark = ExamMark::find($id);
        $submitMark->cat = $request->cat;
        $submitMark->exam = $request->exam;
        $submitMark->save();

        return redirect('/SubmitMarks')->with('success', 'Marks added');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
