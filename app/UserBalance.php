<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    protected $guarded = [];

    public static function lastReplenish(int $userId, int $providerId)
    {
        return  UserBalanceHistory::where('user_id', $userId)
            ->where('cell_provider_id', $providerId)
            ->latest()
            ->first();
    }
}
