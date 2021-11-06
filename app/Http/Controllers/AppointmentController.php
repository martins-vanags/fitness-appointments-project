<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all appointments
     */
    public function show()
    {
        return view('appointments');
    }

    /**
     * Show create appointment form
     */
    public function create()
    {
        return view('teacher.create-appointment');
    }
}
