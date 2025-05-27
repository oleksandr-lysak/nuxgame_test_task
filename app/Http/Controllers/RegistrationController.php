<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

/**
 * Controller for user registration and registration form display.
 */
class RegistrationController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showForm()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->create(
            $request->input('username'),
            $request->input('phonenumber')
        );

        return view('register_success', [
            'link' => route('user.link.show', ['token' => $user->token])
        ]);
    }
} 