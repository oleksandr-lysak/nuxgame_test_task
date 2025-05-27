<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegenerateLinkRequest;
use App\Http\Requests\DeactivateLinkRequest;
use App\Http\Requests\LuckyRequest;
use App\Services\UserService;
use App\Services\LuckyService;

/**
 * Controller for all actions related to the user's unique link (show, regenerate, deactivate, lucky).
 */
class UserController extends Controller
{
    private UserService $userService;
    private LuckyService $luckyService;

    public function __construct(UserService $userService, LuckyService $luckyService)
    {
        $this->userService = $userService;
        $this->luckyService = $luckyService;
    }

    public function show($token)
    {
        $user = $this->userService->getActiveUserOrFail($token);
        return view('user', ['user' => $user]);
    }

    public function regenerate($token)
    {
        $user = $this->userService->getActiveUserOrFail($token);
        $user = $this->userService->regenerate($user);
        return redirect()->route('user.show', ['token' => $user->token]);
    }

    public function deactivate($token)
    {
        $user = $this->userService->getActiveUserOrFail($token);
        $this->userService->deactivate($user);
        return redirect('/')->with('status', 'Link deactivated.');
    }

    public function lucky($token)
    {
        $user = $this->userService->getActiveUserOrFail($token);
        $luckyResult = $this->luckyService->generateLuckyResult($user);
        $message = "Number: {$luckyResult->number} | Result: {$luckyResult->result} | Prize: {$luckyResult->prize}";
        return view('user', [
            'user' => $user,
            'message' => $message,
            'luckyResult' => [
                'number' => $luckyResult->number,
                'result' => $luckyResult->result,
                'prize' => $luckyResult->prize,
            ],
        ]);
    }

    public function history($token)
    {
        $user = $this->userService->getActiveUserOrFail($token);
        $history = $this->luckyService->getLastResults($user, 3);
        return view('user_history', ['user' => $user, 'history' => $history]);
    }
} 