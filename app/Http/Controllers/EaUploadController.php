<?php

namespace App\Http\Controllers;

use App\EaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EaUploadController extends Controller
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
        $files = EaFile::where('user_id', '=', auth()->user()->id)->get();
        return view('EaTube.Upload.index', compact('files'));
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
            'privacy' => 'required',
        ]);
        if ($request->hasFile('file')){
            //Get filename with extension
            $fileNameWithExt =$request->file('file')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('file')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('file')->storeAs('public/EaTube/', $fileNameToStore);

            $upload = new EaFile;
            $upload->user_id = auth()->user()->id;
            $upload->file = $fileNameToStore;
            if ($request->input('privacy') == 'private')
            {
                $upload->private = true;
            }
            else{
                $upload->private = false;
            }
            $upload->description = $request->input('description');


            $upload->save();
            return redirect('/EaUpload')->with('success', 'Upload Successfully');

        }
        else
        {
            return redirect('/EaUpload')->with('error', 'Please Choose a File');
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
        if ($request->hasFile('file')){
            //Get filename with extension
            $fileNameWithExt =$request->file('file')->getClientOriginalName();


            //Get just filename$file
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get just ext
            $extension = $request->file('file')->guessClientExtension();

            //FilenameToStore
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Upload image
            $path = $request->file('file')->storeAs('public/EaTube/', $fileNameToStore);

            $update = EaFile::find($id);
            Storage::delete('public/EaTube/'.$update->file);
            $update->file = $fileNameToStore;
            if ($request->input('privacy') == 'private')
            {
                $update->private = true;
            }
            else{
                $update->private = false;
            }
            $update->description = $request->input('description');

            $update->save();
            return redirect('/EaUpload')->with('success', 'Update Successfully');

        }
        else
        {
            $update = EaFile::find($id);
            if ($request->input('privacy') == 'private')
            {
                $update->private = true;
            }
            else{
                $update->private = false;
            }
            $update->description = $request->input('description');
            $update->save();
            return redirect('/EaUpload')->with('success', 'Update Successfully');
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
        $file = EaFile::find($id);
        if ($file->user_id != auth()->user()->id)
        {
            return redirect('/eatube')->with('error', 'Access Denied');
        }
        $file->delete();

        Storage::delete('public/EaTube/'.$file->file);
        return redirect('/EaUpload')->with('success', 'Delete Successful');
    }
}
