<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\User;

use App\Course;
use App\School;


class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a list of all students.
     * Only admin users can access this.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('adm_num','asc')->paginate(10);
        $courses = Course::all();
        return view('StudentsManagement.index', compact('students', 'courses'));
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
            $courses = Course::all();
            return view('StudentsManagement.create', compact('courses'));
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
            'secondary_email' =>'required',
            'primary_phone' =>'required',
            'secondary_phone' =>'required',
            'postal_address' =>'required',
            'government_sponsored' =>'required',
            'course_id' =>'required',
            'profile_picture' => 'image|max:9999'
        ]);
        //course matching course id
        $course = Course::find($request->course_id);
        $school = School::find($course->school_id);

        //The current year
        $year = date('Y');

        //generate admission number of student
        $unique_adm = generate_string($permitted_chars, 7);

        $adm_num = "$school->adm_start"."/"."$unique_adm"."/".$year;

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
            $path = $request->file('profile_picture')->storeAs('public/students_images', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }


        //Add new student to database
        $student = new Student;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->adm_num = $adm_num;
        $student->nationality = $request->nationality;
        $student->email = $request->email;
        $student->secondary_email = $request->secondary_email;
        $student->primary_phone = $request->primary_phone;
        $student->secondary_phone = $request->secondary_phone;
        $student->postal_address = $request->postal_address;
        $government_sponsored = $request->government_sponsored;
        if ($government_sponsored == 'True') {
            $student->government_sponsored = TRUE;
        }
        elseif ($government_sponsored == 'False') {
            $student->government_sponsored = FALSE;
        }
        else {
            $student->government_sponsored = FALSE;
        }

        //Generating user to student unique key
        $unique_key = generate_string($permitted_chars, 100);//this is student to user unique key

        $student->course_id = $request->course_id;
        $student->year = 1;
        $student-> semester = 1;
        $student->user_key = $unique_key;
        $student->profile_picture = $fileNameToStore;
        $student->save();

        //Create a user account for the student
        $user = new User;
        $user->name = $adm_num;
        $user->email = $request->email;
        $user->password = Hash::make($adm_num);
        $user->is_student = TRUE;
        $user->student_key = $unique_key;
        $user->save();

        return redirect('/StudentsManagement')->with('success', 'Student Admitted');
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
            $student = Student::find($id);
            $courses = Course::all();

            return view('StudentsManagement.edit', compact('student', 'courses'));
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
            'year' => 'required',
            'semester' => 'required',
            'nationality' =>'required',
            'email' =>'required',
            'secondary_email' =>'required',
            'primary_phone' =>'required',
            'secondary_phone' =>'required',
            'postal_address' =>'required',
            'government_sponsored' =>'required',
            'course_id' =>'required',
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
            $path = $request->file('profile_picture')->storeAs('public/students_images', $fileNameToStore);

        }
        //Add new student to database
        $student = Student::find($id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->nationality = $request->nationality;
        $student->email = $request->email;
        $student->secondary_email = $request->secondary_email;
        $student->primary_phone = $request->primary_phone;
        $student->secondary_phone = $request->secondary_phone;
        $student->postal_address = $request->postal_address;
        $student->course_id = $request->course_id;
        $student->year = $request->year;
        $student->semester = $request->semester;
        $government_sponsored = $request->government_sponsored;
        if ($government_sponsored == 'True') {
            $student->government_sponsored = TRUE;
        }
        elseif ($government_sponsored == 'False') {
            $student->government_sponsored = FALSE;
        }
        else {
            $student->government_sponsored = FALSE;
        }

        if ($request->hasFile('profile_picture')){
            Storage::delete('public/students_images/'.$student->profile_picture);
            $student->profile_picture = $fileNameToStore;

        }
        $student->save();

        return redirect('/StudentsManagement')->with('success', 'Student record updated');
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
            $student = Student::find($id);
            if($student->profile_picture != 'noimage.jpg'){
                //Delete
                Storage::delete('public/students_images/'.$student->profile_picture);
            }
            $student->delete();
            return redirect('/StudentsManagement')->with('success', 'Student removed successfully');
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
        }

    }
}
