<?php

namespace App\Http\Controllers;

use App\AcademicYear;
use App\Semester;
use App\Student;
use Illuminate\Http\Request;

class FinanceController extends Controller
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
        if (auth()->user()->fee_admin)
        {
            $year = AcademicYear::all();
            $semester = Semester::all();
            $students = Student::orderBy('adm_num', 'asc')->get();
            return view('finance.index', compact('students', 'year', 'semester'));
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
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
        if (auth()->user()->fee_admin)
        {
            $this->validate($request, [
                'government' =>'required',
                'parallel' =>'required',
            ]);
            $students = Student::all();
            foreach ($students as $student)
            {
                if ($student->government_sponsored == true)
                {
                    $current_credit = $student->credit;
                    $received_addition = $request->input('government');
                    $student->credit = $current_credit + $received_addition;
                    $student->save();
                }
                else
                {
                    $current_credit = $student->credit;
                    $received_addition = $request->input('parallel');
                    $student->credit = $current_credit + $received_addition;
                    $student->save();
                }
            }

            return redirect('/finance')->with('success', 'Amount Added to students credit accounts');
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
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
        if (auth()->user()->fee_admin)
        {
            $this->validate($request, [
                'debit' =>'required',
                'credit' =>'required',
            ]);

            $student = Student::find($id);
            $current_debit = $student->debit;
            $received_debit = $request->debit;
            $current_credit = $student->credit;
            $received_credit = $request->credit;

            $student->debit = $current_debit + $received_debit;
            $student->credit = $current_credit + $received_credit;

            $student->save();

            return redirect('/finance')->with('success', 'Student Fee Account Updated Successfully');
        }
        else
        {
            return redirect('/')->with('error', 'Denied Access');
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
        //
    }
}
