<?php

namespace App\Http\Controllers;

use App\Models\Appointment;

class FrontPageController extends Controller
{
    public function index()
    {
        $appointments = Appointment::paginate(3);

        return view('appointments', ['appointments' => $appointments]);
    }
}
