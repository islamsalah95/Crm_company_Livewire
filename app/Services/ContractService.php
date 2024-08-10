<?php
namespace App\Services;

use App\Models\User;
use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use Carbon\Carbon;


class ContractService
{

    protected $contract;

    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    public function expiration($userId)
    {
        // Retrieve the latest contract for the user
        $contract =  $this->contract::where('user_id', $userId)
            ->latest('created_on')
            ->first();

        // Check if a contract was found
        if ($contract) {
            // Retrieve the end date from the contract
            $endDate = $contract->end_date;

            // Convert the end date string to a Carbon instance for comparison
            $endDate = Carbon::parse($endDate);

            // Get today's date
            $today = Carbon::today();

            // Check if the end date has passed today
            if ($endDate->lessThanOrEqualTo($today)) {
                // End date has passed, contract is invalid
                return false;
            } else {
                // End date is in the future, contract is still valid
                return true;
            }
        } else {
            // No contract found for the user
            return false;
        }
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {

        $user=User::where('id', $request['user_id'])->first();
        $contractExpiration=$this->expiration($user->id);
        // dd($contractExpiration);

        if($user->department==3  && $contractExpiration == false ){
            $this->contract::create($request);
        }else{
            // return view('error',['code'=>500,'message'=>'An error occurred while processing your request.']);
            return  response()->json(['error' => 'An error occurred while processing your request.'], 500);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        return  $contract ;
    }


        /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $this->contract::where('id',$contract)->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {

        return  $contract->delete() ;
    }

    public function userContract($authId)
    {

        return  Contract::where('user_id',$authId)
        ->latest('created_on')
        ->first();
    }




}
