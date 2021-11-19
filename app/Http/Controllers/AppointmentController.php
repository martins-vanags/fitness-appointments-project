<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

    public function create(): Factory|View|Application
    {
        return view('appointments.create');
    }

    public function show(Appointment $appointment): Factory|View|Application
    {
        $coordinates = [
            'lat' => (float)$appointment->latitude,
            'lng' => (float)$appointment->longitude,
        ];

        $alreadyBooked = $appointment->users()->where('user_id', Auth::id())->exists();

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

        $validated['certificate_needed'] = isset($validated['certificate_needed']) ? self::COVID_REQUIRED : self::COVID_NOT_REQUIRED;

        $validated['start_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');
        $validated['end_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');

        $appointment->update($validated);

        return redirect()->route('user.appointments');
    }

    public function store(CreateAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['certificate_needed'] = isset($validated['certificate_needed']) ? self::COVID_REQUIRED : self::COVID_NOT_REQUIRED;

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

    public function booked(): Factory|View|Application
    {
        $appointments = User::findOrFail(Auth::id())->appointments()->paginate(1);

        $coordinates = [];

        foreach ($appointments as $value) {
            $coordinates = [
                'lat' => floatval($value->latitude),
                'lng' => floatval($value->longitude),
            ];
        }

        return view('appointments.booked', [
            'appointments' => $appointments,
            'coordinates' => $coordinates,
        ]);
    }

    public function userAppointments(): Factory|View|Application
    {
        $appointments = Auth::user()->myAppointments;


        return view('user.appointments', [
           'appointments' => $appointments
        ]);
    }
}
