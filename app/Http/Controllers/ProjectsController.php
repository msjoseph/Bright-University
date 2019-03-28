<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
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
        $projects = Project::orderBy('created_at', 'desc')->paginate(10);
        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'description' =>'required',
            'commence' =>'required',
            'finish' =>'required',
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
            $path = $request->file('cover_image')->storeAs('public/projects_images', $fileNameToStore);

        }
        else{
            $fileNameToStore = 'noimage.jpg';
        }

        $project = new Project;
        $project->user_id = auth()->user()->id;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->commence = $request->input('commence');
        $project->finish = $request->input('finish');
        $project->cover_image = $fileNameToStore;
        $project->save();

        return redirect('/projects')->with('success', 'Project added');
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
        $project = Project::find($id);

        if (auth()->user()->id != $project->user_id){
            return redirect('/projects')->with('error', 'Unauthorized Page');
        }

        return view('projects.edit')->with('project', $project);
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
            'description' =>'required',
            'commence' =>'required',
            'finish' =>'required',
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
            $path = $request->file('cover_image')->storeAs('public/projects_images', $fileNameToStore);

        }

        $project = Project::find($id);
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->commence = $request->input('commence');
        $project->finish = $request->input('finish');
        if ($request->hasFile('cover_image')){
            Storage::delete('public/projects_images/'.$project->cover_image);
            $project->cover_image = $fileNameToStore;

        }
        $project->save();

        return redirect('/projects')->with('success', 'Project updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        //check correct user
        /*if (auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
        }*/

        if($project->cover_image != 'noimage.jpg'){
            //Delete
            Storage::delete('public/projects_images/'.$project->cover_image);
        }

        $project->delete();
        return redirect('/projects')->with('success', 'Project removed');
    }
}
