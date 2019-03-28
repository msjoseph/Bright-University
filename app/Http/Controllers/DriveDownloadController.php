<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriveDownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function download($file_name)
    {
        $file_path = public_path() . '/storage/BrightDrive/user_'.auth()->user()->id.'/'.$file_name;
        return response()->download($file_path);
    }
}
