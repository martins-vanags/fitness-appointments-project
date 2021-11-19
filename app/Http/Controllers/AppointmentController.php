<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    const COVID_REQUIRED = 1;
    const COVID_NOT_REQUIRED = 0;

    public function __construct()
    {
        $this->authorizeResource(Appointment::class, 'appointment');
    }

    public function create()
    {
        return view('user.create-appointment');
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        $latLng = [
            'lat' => floatval($appointment->latitude),
            'lng' => floatval($appointment->longitude)
        ];

        $teacher = User::findOrFail($appointment->user_id);

        $alreadyBooked = DB::table('appointment_user')
            ->where('user_id', '=', Auth::id())
            ->where('appointment_id', '=', $id)
            ->get();

        return view('appointments.appointment', [
            'appointment' => $appointment,
            'coordinates' => $coordinates,
            'alreadyBooked' => $alreadyBooked,
        ]);
    }

    public function edit(Appointment $appointment): Factory|View|Application
    {
        return view('appointments.edit', [
            'appointment' => $appointment,
        ]);
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): RedirectResponse
    {
        $validated = $request->validated();

        isset($validated['certificate_needed'])
            ? $validated['certificate_needed'] = self::COVID_REQUIRED
            : $validated['certificate_needed'] = self::COVID_NOT_REQUIRED;

        $validated['start_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');
        $validated['end_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');

        $appointment->update($validated);

        return redirect()->route('user.appointments');
    }

    public function store(CreateAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        isset($validated['certificate_needed'])
            ? $validated['certificate_needed'] = self::COVID_REQUIRED
            : $validated['certificate_needed'] = self::COVID_NOT_REQUIRED;

        Auth::user()->myAppointments()->create($validated);

        return redirect()->route('user.appointments');
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->users()->delete();
        $appointment->delete();

        return redirect()->route('user.appointments');
    }

    public function book(Appointment $appointment): RedirectResponse
    {
        // TODO:
        $appointment->users()->attach(Auth::id());

        return back();
    }
}
