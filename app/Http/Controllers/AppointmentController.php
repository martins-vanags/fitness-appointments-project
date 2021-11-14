<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookAppointmentRequest;
use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\DeleteAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    const COVID_REQUIRED = 1;
    const COVID_NOT_REQUIRED = 0;

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

        return view('appointment', compact('appointment', 'latLng', 'alreadyBooked', 'teacher'));
    }

    public function edit($id)
    {
        if (!Auth::user()->isTeacher()) abort(403);

        $appointments = Appointment::where('user_id', '=', $id)->get();

        return view('user.edit-appointment', compact('appointments'));
    }

    public function update(UpdateAppointmentRequest $request): RedirectResponse
    {
        if (!Auth::user()->isTeacher()) abort(403);

        $validated = $request->validated();

        isset($validated['certificate_needed'])
            ? $validated['certificate_needed'] = self::COVID_REQUIRED
            : $validated['certificate_needed'] = self::COVID_NOT_REQUIRED;

        $validated['start_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');
        $validated['end_time'] = Carbon::parse($validated['start_time'])->format('Y-m-d H:m:s');

        $appointment = Appointment::findOrFail($validated['id']);
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

        $validated['user_id'] = Auth::id();

        isset($validated['certificate_needed'])
            ? $validated['certificate_needed'] = self::COVID_REQUIRED
            : $validated['certificate_needed'] = self::COVID_NOT_REQUIRED;

        Appointment::create($validated);

        return redirect()->route('user.appointments');
    }

    public function destroy(DeleteAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Appointment::findOrFail($validated['id'])->delete();
        DB::table('appointment_user')->where('appointment_id', '=', $validated['id'])->delete();

        return redirect()->route('user.appointments');
    }

    public function book(BookAppointmentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Db::table('appointment_user')->insert([
            'appointment_id' => $validated['id'],
            'user_id' => Auth::id()
        ]);

        return back();
    }
}
