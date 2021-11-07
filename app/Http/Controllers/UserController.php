<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    public function create(CreateAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (!isset($validated['certificate_needed'])) $validated['certificate_needed'] = self::covidNotRequired;
        if ($validated['certificate_needed'] === 'on') $validated['certificate_needed'] = self::covidRequired;

        $user = User::find($validated['id']);
        $user->appointments()->attach(Appointment::create($validated));

        return redirect()->route('user.appointments', ['id' => $validated['id']]);
    }

    public function profile($id)
    {
        $user = User::findOrFail($id);

        return view('user.profile', ['user' => $user]);
    }
}
