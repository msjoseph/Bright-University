<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lecturer;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(10);
        $schools = School::all();
        $lecturers = Lecturer::all();
        return view('courses.index', compact('courses', 'schools', 'lecturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        $lecturers = Lecturer::all();
        return view('courses.create', compact('schools', 'lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>['required', 'unique:courses'],
            'hod' => 'required',
            'school_id' =>'required',
            'units_start' => ['required', 'unique:courses'],
            'main_subjects' =>'required',
            'cut_point' =>'required',
            'cover_image' => 'image|max:9999'
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')){
            //Get filename with extension
            $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('cover_image')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('cover_image')->storeAs('public/courses_images', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $course = new Course;
        $course->name = $request->name;
        $course->hod = $request->input('hod');
        $course->school_id = $request->school_id;
        $course->units_start = $request->input('units_start');
        $course->main_subjects = $request->main_subjects;
        $course->cut_point = $request->cut_point;
        $course->cover_image = $fileNameToStore;
        $course->save();

        return redirect('/courses')->with('success', 'Course added');
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
        $course = Course::find($id);
        $schools = School::all();
        $lecturers = Lecturer::all();

        //check correct user
        /*if (auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }*/

        return view('courses.edit', compact('course', 'schools', 'lecturers'));
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
            'name' =>'required',
            'hod' => 'required',
            'units_start' => ['required'],
            'school_id' =>'required',
            'main_subjects' =>'required',
            'cut_point' =>'required',
            'cover_image' => 'image|max:9999'
        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')){
            //Get filename with extension
            $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('cover_image')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('cover_image')->storeAs('public/courses_images', $fileNameToStore);

        }

        $course = Course::find($id);
        $course->name = $request->input('name');
        $course->hod = $request->input('hod');
        $course->units_start = $request->input('units_start');
        $course->school_id = $request->input('school_id');
        $course->main_subjects = $request->input('main_subjects');
        $course->cut_point = $request->input('cut_point');
        if ($request->hasFile('cover_image')){
            Storage::delete('public/courses_images/'.$course->cover_image);
            $course->cover_image = $fileNameToStore;
        }
        $course->save();

        return redirect('/courses')->with('success', 'Course updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        //check correct user
        /*if (auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }*/

        if($course->cover_image != 'noimage.jpg'){
            //Delete
            Storage::delete('public/courses_images/'.$course->cover_image);
        }

        $course->delete();
        return redirect('/courses')->with('success', 'Course removed');
    }
}
