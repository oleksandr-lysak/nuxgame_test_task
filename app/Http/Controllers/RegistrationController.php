<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

/**
 * Controller for user registration and registration form display.
 */
class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request, UserService $userService)
    {
        $user = $userService->create(
            $request->input('user_name'),
            $request->input('phone_number')
        );

        return view('register_success', [
            'link' => route('user.show', ['token' => $user->token])
        ]);
    }
} 