<?php

namespace App\Services;

use App\Models\User;
use App\Models\LuckyHistory;

class LuckyService
{
    /**
     * Generate a lucky result for the given user and store it in DB.
     */
    public function generateLuckyResult(User $user): LuckyHistory
    {
        $number = rand(1, 1000);
        $isWin = $number % 2 === 0;
        $result = $isWin ? 'Win' : 'Lose';
        $prize = 0;
        if ($isWin) {
            if ($number > 900) {
                $prize = round($number * 0.7, 2);
            } elseif ($number > 600) {
                $prize = round($number * 0.5, 2);
            } elseif ($number > 300) {
                $prize = round($number * 0.3, 2);
            } else {
                $prize = round($number * 0.1, 2);
            }
        }
        return LuckyHistory::create([
            'user_id' => $user->id,
            'number' => $number,
            'result' => $result,
            'prize' => $prize,
        ]);
    }

    /**
     * Get the last N lucky results for the given user.
     */
    public function getLastResults(User $user, int $count = 3)
    {
        return $user->luckyHistories()->latest()->take($count)->get();
    }
} 