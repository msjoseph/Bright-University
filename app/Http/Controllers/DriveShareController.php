<?php

namespace App\Http\Controllers;

use App\BrightDrive;
use App\DriveShare;
use Illuminate\Http\Request;

class DriveShareController extends Controller
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

            if (auth()->user()->drive_user)
            {
                $user_id = auth()->user()->id;
                $plan = 'free5';
                $accounts = BrightDrive::where('user_id', '=' ,$user_id)->get();
                foreach ($accounts as $account)
                {
                    if ($account->plan == 'ultimate')
                    {
                        $plan = 'ultimate';
                    }
                }
                $SharedFiles = DriveShare::where('owner_id', '=' ,$user_id)->get();
                return view('BrightDrive.SharedFiles', compact('SharedFiles', 'plan'));
            }
            else
            {
                return view('BrightDrive.guest');
            }

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
        //
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
