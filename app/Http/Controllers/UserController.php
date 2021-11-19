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

    /**
     * Returns user profile information
     */
    public function show(User $user): Factory|View|Application
    {
        return view('user.profile', [
            'user' => $user
        ]);
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function edit(User $user): Factory|View|Application
    {
        return view('user.edit', [
            'user' => $user
        ]);
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
        $user->save($validated);

        return back();
    }
}
