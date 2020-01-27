<?php

namespace App\Http\Controllers\Api;

use App\CellProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserBalanceFormRequest;
use App\UserBalanceHistory;
use Illuminate\Http\Request;
use App\UserBalance;

class UserBalanceController extends Controller
{

    /**
     * @param UserBalanceFormRequest $request
     * @param $cellProviderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserBalanceFormRequest $request, $cellProviderId)
    {
        $request->validated();

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

        return response()->json();
    }

    /**
     * @param $cellProviderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($cellProviderId)
    {
        $provider = CellProvider::findOrFail($cellProviderId);
        $lastUserReplenish = UserBalance::lastReplenish(auth()->id(), $provider->id);
        return response()->json($lastUserReplenish);
    }
}
