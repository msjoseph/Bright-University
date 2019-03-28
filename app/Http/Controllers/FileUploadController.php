<?php

namespace App\Http\Controllers;

use App\BrightDrive;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
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
            $plan = 'free5';
            $accounts = BrightDrive::where('user_id', '=' ,auth()->user()->id)->get();
            foreach ($accounts as $account)
            {
                if ($account->plan == 'ultimate')
                {
                    $plan = 'ultimate';
                }
            }
            return view('BrightDrive.fileupload', compact('plan'));
        }
        else
        {
            return redirect('/BrightDrive')->with('error', 'Ensure you have a BrightDrive Account');
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
        $backed_files = File::where('user_id', '=' ,auth()->user()->id)->get();

        //Handle file upload
        if ($request->hasFile('filename'))
        {
            for ($i = 0; $i <count($request->file('filename'));$i++)
            {
                $file = $request->file('filename')[$i];
                $destination_path = public_path() . '/storage/BrightDrive/user_'.auth()->user()->id;
                $extension = $file->getClientOriginalExtension();
                #$size = $file->getSize();
                $name_only = $file->getClientOriginalName();
                foreach ($backed_files as $backed_file)
                {
                    if ($backed_file->filename == $name_only)
                    {
                        return redirect('/BrightDriveUpload')->with('error', 'Upload stopped due to existing file');
                    }
                }

                $filename = $name_only;
                $file->move($destination_path, $filename);

                $upload = new File;
                $upload->user_id = auth()->user()->id;
                $upload->filename = $filename;
                if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')
                {
                    $upload->category = 'photo';
                }
                else if ($extension == 'MP4' || $extension == 'mp4' || $extension == 'mkv'  || $extension == 'MKV'
                    || $extension == 'flv' || $extension == 'avi')
                {
                    $upload->category = 'video';
                }
                else if ($extension == 'mp3' || $extension == 'm4a' || $extension == 'MP3' || $extension == 'M4A')
                {
                    $upload->category = 'audio';
                }
                else if ($extension == 'pdf' || $extension == 'PDF' || $extension == 'txt' || $extension == 'TXT'
                    || $extension == 'docx' || $extension == 'DOCX')
                {
                    $upload->category = 'doc';
                }
                else if ($extension == 'exe' || $extension == 'EXE'|| $extension == 'deb' || $extension == 'DEB'||
                    $extension == 'rpm' || $extension == 'RPM'|| $extension == 'msi' || $extension == 'MSI')
                {
                    $upload->category = 'program';
                }
                else if ($extension == 'zip' || $extension == 'ZIP' || $extension == 'rar' || $extension == 'RAR'
                    || $extension == 'iso' || $extension == 'ISO' )
                {
                    $upload->category = 'compressed';
                }
                else
                {
                    $upload->category = 'others';
                }

                $upload->save();
            }

            return redirect('/BrightDrive')->with('success', 'Upload done');

        }
        else
        {
            return redirect('/BrightDriveUpload')->with('error', 'You did not choose a file');
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
        $file = File::find($id);
        if ($file->user_id == auth()->user()->id)
        {
            $file->delete();
            Storage::delete('public/BrightDrive/user_'.auth()->user()->id.'/'.$file->filename);
            return redirect('/BrightDrive')->with('success', $file->filename.' removed');
        }
        else
        {
            return redirect('/BrightDrive')->with('error', 'Access Denied');
        }
    }


}
