<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\DeleteAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    const covidRequired = 1;
    const covidNotRequired = 0;

    public function create()
    {
        return view('user.create-appointment');
    }

    public function edit($id)
    {
        $appointment = User::findOrFail(Auth::user()->id)->appointments()->findOrFail($id);

        return view('user.edit-appointment', ['appointment' => $appointment]);
    }

    public function update(UpdateAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        isset($validated['certificate_needed'])
            ? $validated['certificate_needed'] = self::covidRequired
            : $validated['certificate_needed'] = self::covidNotRequired;

        $validated['start_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');
        $validated['end_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');

        $appointment = User::findOrFail(Auth::user()->id)
            ->appointments()
            ->find($validated['id']);

        $appointment->name = $validated['name'];
        $appointment->latitude = $validated['latitude'];
        $appointment->longitude = $validated['longitude'];
        $appointment->student_count = $validated['student_count'];
        $appointment->start_time = $validated['start_time'];
        $appointment->end_time = $validated['end_time'];
        $appointment->certificate_needed = $validated['certificate_needed'];
        $appointment->price = $validated['price'];
        $appointment->description = $validated['description'];
        $appointment->save();

        return redirect()->route('user.appointments');
    }

    public function store(CreateAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        isset($validated['certificate_needed'])
            ? $validated['certificate_needed'] = self::covidRequired
            : $validated['certificate_needed'] = self::covidNotRequired;

        $user = User::findOrFail(Auth::user()->id);
        $user->appointments()->attach(Appointment::create($validated));

        return redirect()->route('user.appointments', ['id' => Auth::user()->id]);
    }

    public function destroy(DeleteAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::findOrFail(Auth()->user()->id);
        $user->appointments()->detach(Appointment::findorFail($validated['id']));
        Appointment::findOrFail($validated['id'])->delete();

        return redirect()->route('user.appointments', ['id' => Auth::user()->id]);
    }
}
