<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    const covidRequired = 1;
    const covidNotRequired = 0;

    public function create(CreateAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (!isset($validated['certificate_needed'])) $validated['certificate_needed'] = self::covidNotRequired;
        if ($validated['certificate_needed'] === 'on') $validated['certificate_needed'] = self::covidRequired;

        $user = User::find($validated['id']);
        $user->appointments()->attach(Appointment::create($validated));

        return redirect()->route('user.appointments', ['id' => $validated['id']]);
    }
}
