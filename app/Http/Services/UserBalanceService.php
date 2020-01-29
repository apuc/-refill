<?php


namespace App\Http\Services;

use App\CellProvider;
use App\UserBalance;
use App\UserBalanceHistory;

class UserBalanceService
{

    /**
     * refill balance and set it to history
     * @param $request
     * @param $cellProviderId
     */
    public static function refillBalance($request, $cellProviderId){
        $provider = CellProvider::findOrFail($cellProviderId);
        $userBalance = UserBalance::where('user_id', auth()->id())
            ->where('cell_provider_id', $provider->id)
            ->first();

        if ($userBalance) {
            $userBalance->balance += $request->amount;
            $userBalance->save();
        } else {
            UserBalance::create([
                'user_id' => auth()->id(),
                'cell_provider_id' => $provider->id,
                'balance' => $request->amount
            ]);
        }
        $balanceHistory = (new UserBalanceHistory([
            'user_id' => auth()->id(),
            'cell_provider_id' => $provider->id
        ]))->fill($request->all());
        $balanceHistory->save();
    }
}
