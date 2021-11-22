<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function show(User $user): Factory|View|Application
    {
        return view('user.profile', [
            'user' => $user
        ]);
    }

    public function edit(User $user): Factory|View|Application
    {
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(UpdateUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = Auth::user();
        $user->save($validated);

        return back();
    }
}
