<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;

class ContractController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {

        $userContracts=$user->contracts;

        return view('crm.contracts.show',compact('userContracts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('crm.contracts.create',compact('user'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
