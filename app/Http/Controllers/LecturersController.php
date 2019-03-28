<?php

namespace App\Http\Controllers;

use App\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;

use App\Course;
use App\School;


class LecturersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a list of all students.
     * Only admin users can access this.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = Lecturer::orderBy('reg_num','asc')->paginate(10);
        $schools = School::all();
        return view('lecturers.index', compact('lecturers', 'schools'));
    }

    /**
     * Show the form for adding a student to the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->is_admin)
        {
            $schools = School::all();
            return view('lecturers.create', compact('schools'));
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
        }


    }

    /**
     * Store a new student in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

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
            'first_name' =>'required',
            'last_name' =>'required',
            'nationality' =>'required',
            'email' =>['required', 'unique:users'],
            'phone' =>'required',
            'is_government' =>'required',
            'school_id' =>'required',
            'profile_picture' => 'image|max:9999'
        ]);
        //The current year
        $year = date('Y');

        //generate admission number of student
        $unique_reg = generate_string($permitted_chars, 7);

        $reg_num = "LEC"."/"."$unique_reg"."/".$year;

        //Handle picture upload
        if ($request->hasFile('profile_picture')){
            //Get filename with extension
            $fileNameWithExt =$request->file('profile_picture')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('profile_picture')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('profile_picture')->storeAs('public/lecturers_images', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }


        //Add new lecturer to database
        $lecturer = new Lecturer;
        $lecturer->first_name = $request->first_name;
        $lecturer->last_name = $request->last_name;
        $lecturer->reg_num = $reg_num;
        $lecturer->nationality = $request->nationality;
        $lecturer->email = $request->email;
        $lecturer->phone = $request->phone;
        $is_government = $request->is_government;
        if ($is_government == 'True') {
            $lecturer->is_government = TRUE;
        }
        elseif ($is_government == 'False') {
            $lecturer->is_government = FALSE;
        }
        else {
            $lecturer->is_government = FALSE;
        }

        //Generating user to lecturer unique key
        $unique_key = generate_string($permitted_chars, 100);//this is lecturer to user unique key

        $lecturer->school_id = $request->school_id;
        $lecturer->user_key = $unique_key;
        $lecturer->profile_picture = $fileNameToStore;
        $lecturer->save();

        //Create a user account for the student
        $user = new User;
        $user->name = $reg_num;
        $user->email = $request->email;
        $user->password = Hash::make($reg_num);
        $user->is_lecturer = TRUE;
        $user->lecturer_key = $unique_key;
        $user->save();

        return redirect('/lecturers')->with('success', 'Lecturer Added');
    }

    /**
     * Display the specified student.
     * Admin users and the specified logged in student can access here
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified student.
     * Admin users are allowed here
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->is_admin)
        {
            $lecturer = Lecturer::find($id);
            $schools = School::all();
            return view('lecturers.edit', compact('schools', 'lecturer'));
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
        }

    }

    /**
     * Update the specified student in database.
     * Allowed to only admin users
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' =>'required',
            'last_name' =>'required',
            'nationality' =>'required',
            'email' =>['required'],
            'phone' =>'required',
            'is_government' =>'required',
            'school_id' =>'required',
            'profile_picture' => 'image|max:9999'
        ]);

        //Handle picture upload
        if ($request->hasFile('profile_picture')){
            //Get filename with extension
            $fileNameWithExt =$request->file('profile_picture')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('profile_picture')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('profile_picture')->storeAs('public/lecturers_images', $fileNameToStore);

        }


        //Update lecturer records database
        $lecturer = Lecturer::find($id);
        $lecturer->first_name = $request->first_name;
        $lecturer->last_name = $request->last_name;
        $lecturer->nationality = $request->nationality;
        $lecturer->email = $request->email;
        $lecturer->phone = $request->phone;
        $is_government = $request->is_government;
        if ($is_government == 'True') {
            $lecturer->is_government = TRUE;
        }
        elseif ($is_government == 'False') {
            $lecturer->is_government = FALSE;
        }
        else {
            $lecturer->is_government = FALSE;
        }

        if ($request->hasFile('profile_picture')){
            if($lecturer->profile_picture != 'noimage.jpg'){
                Storage::delete('public/lecturers_images/'.$lecturer->profile_picture);
                $lecturer->profile_picture = $fileNameToStore;
            }


        }

        $lecturer->save();


        return redirect('/lecturers')->with('success', 'Lecturer record updated');
    }

    /**
     * Remove the specified student from database.
     * Can be accessed by only to the RootUser.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->is_admin)
        {
            $lecturer = Lecturer::find($id);
            if($lecturer->profile_picture != 'noimage.jpg'){
                //Delete
                Storage::delete('public/lecturers_images/'.$lecturer->profile_picture);
            }
            $lecturer->delete();

            return redirect('/lecturers')->with('success', 'Lecturer removed');
        }
        else
        {
            return redirect('/lecturers')->with('We do not know how you got here !!!');
        }
    }
}
