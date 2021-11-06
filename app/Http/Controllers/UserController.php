<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const covidRequired = 1;
    const covidNotRequired = 0;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $userAppointments = User::findOrFail($id)->appointments;
        
        return view('user.appointments', ['appointments' => $userAppointments]);
    }

    public function create(CreateAppointmentRequest $request)
    {
        $validated = $request->validated();

        if ($validated['require-certificate'] === 'on') $validated['require-certificate'] = self::covidRequired;
        if ($validated['require-certificate'] === 'off') $validated['require-certificate'] = self::covidNotRequired;

        $user = User::find(Auth::user()->id);
        $user->appointments()->attach(
            Appointment::create([
                'name' => $validated['name'],
                'latitude' => $validated['lat'],
                'longitude' => $validated['lng'],
                'student_count' => $validated['number-of-students'],
                'start_time' => $validated['start-time'],
                'end_time' => $validated['end-time'],
                'price' => $validated['price'],
                'certificate_needed' => $validated['require-certificate']
            ])
        );

        // TODO:
        // The link stays the same after return
        // /create
        // How to change ?
        return $this->show(Auth::user()->id);
    }
}
