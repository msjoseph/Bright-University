<?php

namespace App\Http\Controllers;

use App\BrightDrive;
use App\File;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrightDriveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest())
        {
            return view('BrightDrive.guest');
        }
        else
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
                $files = File::where('user_id', '=' ,$user_id)->get();
                return view('BrightDrive.DriveUser', compact('files', 'plan'));
            }
            else
            {
                return view('BrightDrive.guest');
            }
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

        if (auth()->user()->drive_user == true)
        {
            return view('BrightDrive.guest')->with('error', 'An account already exists');
        }
        else {

            $this->validate($request, [
                'plan' => 'required',
                'profile_picture' => 'image|max:9999'
            ]);

            //Profile Picture
            if ($request->hasFile('profile_picture')) {
                //Get filename with extension
                $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();


                //Get just filename$file
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                //Get just ext
                $extension = $request->file('profile_picture')->guessClientExtension();

                //FilenameToStore
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                //Upload image
                $path = $request->file('profile_picture')->storeAs('public/BrightDrive_users', $fileNameToStore);

            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $account = new BrightDrive;
            $account->user_id = auth()->user()->id;
            if ($request->input('plan') == 'free5') {
                $account->plan = $request->input('plan');
            }
            if ($request->input('plan') == 'ultimate') {
                $account->plan = $request->input('plan');
            }
            $account->profile_picture = $fileNameToStore;

            $user = User::find(auth()->user()->id);
            $user->drive_user = true;
            $account->save();
            $user->save();

            return redirect('/BrightDrive')->with('success', 'account created successfully');
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
