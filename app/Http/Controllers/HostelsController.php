<?php

namespace App\Http\Controllers;

use App\Hostel;
use App\HostelBooking;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HostelsController extends Controller
{
    /**
     * Create access controll nstance.
     *
     * @return void
     */
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
        $hostel_owners = User::where('is_hostel_owner', true)->get();
        $hostels = Hostel::orderBy('rem_rooms', 'desc')->paginate(20);
        $bookedHostels = HostelBooking::all();
        $students = Student::all();
        $users = User::where('is_student', true)->get();
        return view('hostels.index', compact('hostels', 'hostel_owners', 'bookedHostels', 'students', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->is_hostel_owner == false){
            return redirect('/hostels')->with('error', 'Sorry, You must register as an hostel owner');
        }
        return view('hostels.create');
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
            'name' => ['required', 'string', 'unique:hostels'],
            'rooms' =>'required',
            'num_per_room' =>'required',
            'rem_rooms' =>'required',
            'rent' =>'required',
            'bank' =>'required',
            'image' => 'image|max:9999'
        ]);

        //Handle file upload
        if ($request->hasFile('image')){
            //Get filename with extension
            $fileNameWithExt =$request->file('image')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('image')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('image')->storeAs('public/hostel_images', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $hostel = new Hostel;
        $hostel->user_id = auth()->user()->id;
        $hostel->name = $request->input('name');
        $hostel->rooms = $request->input('rooms');
        $hostel->num_per_room = $request->input('num_per_room');
        $hostel->rem_rooms = $request->input('rem_rooms');
        $hostel->rent = $request->input('rent');
        $hostel->bank = $request->input('bank');
        $hostel->image = $fileNameToStore;

        $hostel->save();

        return redirect('/hostels')->with('success', 'Hostel Added Successfully');
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
        $hostel = Hostel::find($id);
        if (auth()->user()->id != $hostel->user_id){
            return redirect('/hostels')->with('error', 'Sorry, Unauthorized page');
        }
        return view('hostels.edit', compact('hostel'));
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
            'rooms' =>'required',
            'num_per_room' =>'required',
            'rem_rooms' =>'required',
            'rent' =>'required',
            'bank' =>'required',
            'image' => 'image|max:9999'
        ]);

        //Handle file upload
        if ($request->hasFile('image')){
            //Get filename with extension
            $fileNameWithExt =$request->file('image')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('image')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('image')->storeAs('public/hostel_images', $fileNameToStore);

        }

        $hostel = Hostel::find($id);
        $hostel->name = $request->input('name');
        $hostel->rooms = $request->input('rooms');
        $hostel->num_per_room = $request->input('num_per_room');
        $hostel->rem_rooms = $request->input('rem_rooms');
        $hostel->rent = $request->input('rent');
        $hostel->bank = $request->input('bank');
        if ($request->hasFile('image')){
            Storage::delete('public/hostel_images/'.$hostel->cover_image);
            $hostel->image = $fileNameToStore;

        }
        $hostel->save();

        return redirect('/hostels')->with('success', 'Hostel Records Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hostel = Hostel::find($id);
        if (auth()->user()->id != $hostel->user_id){
            return redirect('/hostels')->with('error', 'Sorry, Unauthorized page');
        }
        if($hostel->image != 'noimage.jpg'){
            //Delete
            Storage::delete('public/hostel_images/'.$hostel->image);
        }
        $hostel->delete();
        return redirect('/hostels')->with('success', 'Hostel Removed');
    }
}
