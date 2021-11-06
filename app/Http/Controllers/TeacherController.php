<?php

namespace App\Http\Controllers;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show teacher appointments
     */
    public function show()
    {
        return view('teacher.my-appointments');
    }
}
