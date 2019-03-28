<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lecturer;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolsController extends Controller
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
        $lecturers = Lecturer::all();
        $schools = School::orderBy('created_at', 'desc')->paginate(20);
        $courses = Course::all();
        return view('schools.index', compact('schools', 'lecturers', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lecturers = Lecturer::all();
        return view('schools.create', compact('lecturers'));
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
            'name' =>'required',
            'dean' => 'required',
            'adm_start' =>['required', 'unique:schools'],
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
            $path = $request->file('cover_image')->storeAs('public/schools_images', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $school = new School;
        $school->name = $request->input('name');
        $school->dean = $request->input('dean');
        $school->adm_start = $request->adm_start;
        $school->cover_image = $fileNameToStore;
        $school->save();

        return redirect('/schools')->with('success', 'School added');
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
        $school = School::find($id);
        $lecturers = Lecturer::all();

        //check correct user
        /*if (auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }*/

        return view('schools.edit', compact('school', 'lecturers'));
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
            'dean' => 'required',
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
            $path = $request->file('cover_image')->storeAs('public/schools_images', $fileNameToStore);

        }

        $school = School::find($id);
        $school->name = $request->input('name');
        $school->dean = $request->input('dean');
        if ($request->hasFile('cover_image')){
            Storage::delete('public/schools_images/'.$school->cover_image);
            $school->cover_image = $fileNameToStore;
        }
        $school->save();

        return redirect('/schools')->with('success', 'School updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);

        if($school->cover_image != 'noimage.jpg'){
            //Delete
            Storage::delete('public/schools_images/'.$school->cover_image);
        }

        $school->delete();
        return redirect('/hostels')->with('success', 'School removed');
    }
}
