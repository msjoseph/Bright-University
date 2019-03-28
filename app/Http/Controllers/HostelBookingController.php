<?php

namespace App\Http\Controllers;

use App\Hostel;
use App\HostelBooking;
use App\Student;
use App\User;
use Illuminate\Http\Request;

class HostelBookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostels = Hostel::all();
        $bookedHostels = HostelBooking::all();
        $users = User::where('is_student', true)->get();
        $students = Student::all();
        return view('HostelBooking.index', compact('hostels', 'bookedHostels', 'users', 'students'));
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
        $this->validate($request,[
            'hostel_id' => 'required',
        ]);

        $booked = false;

        if (auth()->user()->is_student == true)
        {
            $bookedHostels = HostelBooking::all();
            foreach ($bookedHostels as $bookedHostel)
            {
                if ($bookedHostel->user_id == auth()->user()->id)
                {
                    $booked = true;
                }

            }
            if ($booked != true)
            {
                $booking = new HostelBooking;
                $booking->hostel_id = $request->input('hostel_id');
                $booking->user_id = auth()->user()->id;
                $booking->save();

                return redirect('/hostels')->with('success', 'Booking request sent. Wait for approval.');
            }
            else
            {
                return redirect('/hostels')->with('error', 'You can only book one hostel.');
            }


        }
        else
        {
            return redirect('/hostels')->with('error', 'Hostel Booking available for students only');
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
        $this->validate($request, [
            'action'=>'required',
        ]);
        $bookedHostel = HostelBooking::find($id);
        if ($request->input('action') == 'approve')
        {
            $bookedHostel->approved = true;
            $bookedHostel->room_num = $request->input('room');
            $bookedHostel->save();
            return redirect('/hostels')->with('success', 'Request approved');
        }
        if ($request->input('action') == 'cancel')
        {
            $bookedHostel->is_cancelled = true;
            $bookedHostel->save();

            return redirect('/hostels')->with('success', 'Request cancelled');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hostel = HostelBooking::find($id);
        $hostel->delete();
        return redirect('/hostels')->with('success', 'Request cancelled');
    }
}
