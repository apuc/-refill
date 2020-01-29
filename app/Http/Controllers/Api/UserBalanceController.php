<?php

namespace App\Http\Controllers\Api;

use App\CellProvider;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserBalanceFormRequest;
use App\Http\Services\UserBalanceService;
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
        UserBalanceService::refillBalance($request, $cellProviderId);
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
