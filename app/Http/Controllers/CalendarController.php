<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\AcademicYear;
use App\Semester;

class CalendarController extends Controller
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
        $this->validate($request, [
            'academic_year' =>'required',
            'semester' =>'required',
        ]);
        $year_id = $request->year_id;
        $semester_id = $request->semester_id;

        $year = AcademicYear::find($year_id);
        $year->academic_year = $request->academic_year;
        $year->save();

        $students = Student::all();
        foreach ($students as $student)
        {
            $student->semester = $request->semester;
            $student->save();

        }

        $semester = Semester::find($semester_id);
        $semester->semester = $request->semester;
        $semester->save();

        return redirect('/dashboard')->with('success', 'Update made successfully');
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
        //
    }
}
