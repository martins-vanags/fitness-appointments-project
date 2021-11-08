<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $userAppointments = User::findOrFail(Auth::user()->id)->appointments;

        return view('user.appointments', ['appointments' => $userAppointments]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.profile', ['user' => $user]);
    }

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
