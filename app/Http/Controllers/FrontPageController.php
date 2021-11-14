<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class FrontPageController extends Controller
{
    public function index()
    {
        $appointments = Appointment::paginate(4);

        return view('appointments', ['appointments' => $appointments]);
    }
}
