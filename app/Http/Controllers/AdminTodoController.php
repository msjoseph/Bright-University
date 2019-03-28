<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminTodo;

class AdminTodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        //
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
        $this->validate($request, [
            'title' =>'required',
            'body' =>'required',
            'start' =>'required',
            'deadline' =>'required',
        ]);

        $todo = new AdminTodo;
        $todo->title = $request->input('title');
        $todo->body = $request->input('body');
        $todo->user_id = auth()->user()->id;
        $todo->start = $request->input('start');
        $todo->deadline = $request->input('deadline');
        $todo->save();

        return redirect('/dashboard')->with('success', 'Task created');

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
        $task = AdminTodo::find($id);


        if (auth()->user()->id != $task->user_id){
            return redirect('/news')->with('error', 'Sorry, Unauthorized page');
        }

        $task->delete();
        return redirect('/dashboard')->with('success', 'To-Do item removed');
    }
}
