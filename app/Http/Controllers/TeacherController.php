<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    const covid_required = 1;
    const covid_not_required = 0;

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

    public function create(CreateAppointmentRequest $request)
    {
        $validated = $request->validated();

        if ($validated['require-certificate'] === 'on') $validated['require-certificate'] = self::covid_required;
        if ($validated['require-certificate'] === 'off') $validated['require-certificate'] = self::covid_not_required;

        Appointment::create([
            'name' => $validated['name'],
            'latitude' => $validated['lat'],
            'longitude' => $validated['lng'],
            'student_count' => $validated['number-of-students'],
            'start_time' => $validated['start-time'],
            'end_time' => $validated['end-time'],
            'price' => $validated['price'],
            'certificate_needed' => $validated['require-certificate']
        ]);

        return view('teacher.my-appointments');
    }
}
