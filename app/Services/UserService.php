<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class UserService
{
    public function create(string $username, string $phonenumber): User
    {
        return User::create([
            'username' => $username,
            'phonenumber' => $phonenumber,
            'token' => Str::random(32),
            'expires_at' => now()->addDays(7),
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
            'expires_at' => now()->addDays(7),
            'active' => true,
        ]);
        return $user;
    }

    public function deactivate(User $user): void
    {
        $user->update(['active' => false]);
    }
} 