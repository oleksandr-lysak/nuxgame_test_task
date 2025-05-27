<?php

namespace App\Services;

use App\Models\User;
use COM;
use Illuminate\Support\Str;
use \Illuminate\Support\Carbon;

class UserService
{
    public function create(string $userName, string $phoneNumber): User
    {
        return User::create([
            'user_name' => $userName,
            'phone_number' => $phoneNumber,
            'token' => Str::random(32),
            'expires_at' => $this->getExpiresAt(),
            'active' => true,
        ]);
    }

    public function getActiveUserOrFail(string $token): User
    {
        return User::where('token', $token)
            ->where('active', true)
            ->where('expires_at', '>', now())
            ->firstOrFail();
    }

    public function regenerate(User $user): User
    {
        $user->update([
            'token' => Str::random(32),
            'expires_at' => $this->getExpiresAt(),
            'active' => true,
        ]);
        return $user;
    }

    private function getExpiresAt(): Carbon
    {
        return now()->addMinute();
    }

    public function deactivate(User $user): void
    {
        $user->update(['active' => false]);
    }
} 