<?php

namespace App\Http\Controllers;

use App\Lecturer;
use Illuminate\Http\Request;
use App\Course;
use App\Unit;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $lecturers = Lecturer::all();
        $units = Unit::orderBy('code', 'asc')->paginate(10);
        return view('units.index', compact('courses', 'units', 'lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $lecturers = Lecturer::all();
        return view('units.create', compact('courses', 'lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permitted_chars = '0123456789';

        function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }

            return $random_string;
        }

        $this->validate($request, [
            'name' =>['required','unique:units'],
            'course_id' =>'required',
            'year' =>'required',
            'semester' =>'required',
            'lecturer_id' =>'required'
        ]);
        $course = Course::find($request->course_id);
        $unique_code = generate_string($permitted_chars, 3);
        $unit_code = "$course->units_start"."$unique_code";

        $unit = new Unit;
        $unit->name = $request->name;
        $unit->code = $unit_code;
        $unit->course_id = $request->course_id;
        $unit->year = $request->year;
        $unit->semester = $request->semester;
        $unit->lecturer_id = $request->lecturer_id;
        $unit->save();

        return redirect('/units')->with('success', 'Unit Added');

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
        $courses = Course::all();
        $lecturers = Lecturer::all();

        $unit = Unit::find($id);
        return view('units.edit', compact('courses', 'lecturers', 'unit'));
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
            'name' =>['required'],
            'course_id' =>'required',
            'year' =>'required',
            'semester' =>'required',
            'lecturer_id' =>'required'
        ]);

        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->course_id = $request->course_id;
        $unit->year = $request->year;
        $unit->semester = $request->semester;
        $unit->lecturer_id = $request->lecturer_id;
        $unit->save();

        return redirect('/units')->with('success', 'Unit Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();

        return redirect('/units')->with('success', 'Unit removed');

    }
}
