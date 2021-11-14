<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Require authorization
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Returns user created appointments
     */
    public function show()
    {
        $appointments = Appointment::where('user_id', '=', Auth::id())->get();

        return view('user.appointments', compact('appointments'));
    }

    /**
     * Returns user booked appointments
     */
    public function booked()
    {
        $booked = User::findOrFail(Auth::id())->appointments()->paginate(1);

        $latLng = [];
        
        foreach ($booked as $value) {
            $latLng = [
                'lat' => floatval($value->latitude),
                'lng' => floatval($value->longitude)
            ];
        }


        return view('user.booked-appointments', compact('booked', 'latLng'));
    }

    /**
     * @param $id
     * Returns user information
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.profile', compact('user'));
    }

    /**
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     * Updates user information
     */
    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = Auth::user();
        $user->name = $validated['name'];
        $user->surname = $validated['surname'];
        $user->gender = $validated['gender'];
        $user->age = $validated['age'];
        $user->description = $validated['description'];
        $user->save();

        return back();
    }
}
