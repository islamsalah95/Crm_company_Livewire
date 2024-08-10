<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Shift;
use App\Models\Contract;
use Illuminate\Support\Facades\Auth;


class ShiftService
{

    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
        } else {
            return Auth::user()->company_id;
        }
    }

    public function isStarted(){
        $isStarted=Shift::
            where('check_out',null)->
            where('user_id',Auth::user()->id)->
            where('company_id',$this->AuthCompanyId())->first();
            return $isStarted;
    }


    public function expiration($userId)
    {
        // Retrieve the latest contract for the user
        $contract =  Contract::where('user_id', $userId)
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


    public function shifts($auth,$search,$paginate=5,$startDate='',$endDate='')
    {

        $contract =  Contract::where('user_id',$auth->id)
        ->latest('created_on')
        ->first();
        if($paginate){
            if($startDate && $endDate ){
                //start and end
                $shifts = Shift::where('user_id', $auth->id)
                    ->where('company_id', $auth->company_id)
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('created_at', 'like', '%' . $search. '%')
                    ->paginate($paginate);
                  }
                else if($startDate){
                //today
                $shifts = Shift::where('user_id', $auth->id)
                ->where('company_id',$auth->company_id)
                ->whereDate('created_at',$startDate)
                ->where('created_at', 'like', '%' . $search. '%')
                ->paginate($paginate);
            }
            else{
                //all
                $startDateTime = Carbon::parse($contract->start_date)->startOfDay();
                $endDateTime = Carbon::parse($contract->end_date)->endOfDay();
                $shifts = Shift::where('user_id', $auth->id)
                ->where('company_id', $auth->company_id)
                ->whereBetween('created_at', [$startDateTime, $endDateTime])
                ->where('created_at', 'like', '%' . $search. '%')
                ->paginate($paginate);
            }
        }else{
            if($startDate && $endDate ){
                // from to working Hours
                $shifts = Shift::where('user_id',  $auth->id)
                ->where('company_id', $auth->company_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
              }
          else if($startDate){
            // sacific day working Hours
            $shifts = Shift::where('user_id',  $auth->id)
            ->where('company_id', $auth->company_id)
            ->whereDate('created_at',$startDate)
            ->get();
          }else{
           // Total Hours  for contract
            $startDateTime = Carbon::parse($contract->start_date)->startOfDay();
            $endDateTime = Carbon::parse($contract->end_date)->endOfDay();
            $shifts = Shift::where('user_id',  $auth->id)
            ->where('company_id',$auth->company_id)
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->get();
          }
        }


    return $shifts ;
    }



    public function store($request)
    {

        $shift= new Shift();
        $shift->name=$request['name'];
        $shift->project_id=$request['project_id'];
        $shift->company_id=$request['company_id'];
        $shift->start_date=$request['start_date'];
        $shift->end_date=$request['end_date'];
        $shift->type=$request['type'];
        $shift->save();

       if ($shift->id && $request['user_id'] !==[] ) {
           $shift->users()->attach($request['user_id']);
       }

    }


    public function destroy($shift)
    {
        $shift=Shift::findOrfail($shift);
        return  $shift->delete() ;
    }

    public function ContractHours($auth,$startDate='',$endDate='')
    {
        $timer=[];
        // dd($auth->id);
        // Retrieve the latest contract for the user
        $contract =  Contract::where('user_id',$auth->id)
            ->latest('created_on')
            ->first();

        $shifts = $this->shifts($auth,$search='',$paginate='',$startDate,$endDate);


            foreach($shifts  as $shift){
                $timer[]=calculateTimeDifference($shift->check_in,$shift->check_out);
            }
            return ['timer'=>$timer,'contract'=>$contract,];
        }

    public function totalContractHours($auth)
    {
        // Total Hours  for contract
        $array=$this->ContractHours($auth);
        $isTotalHoursLessThanPerContract=isTotalHoursLessThan(sumTimes($array['timer']),$array['contract']->working_hours);

        // today  working Hours
        $arrayIsTotalHoursLessThanPerDay=$this->ContractHours($auth,Carbon::today());
        $isTotalHoursLessThanPerDay=isTotalHoursLessThan(sumTimes($arrayIsTotalHoursLessThanPerDay['timer']),$arrayIsTotalHoursLessThanPerDay['contract']->working_hours_per_day);

        // weekly  working Hours
        $startOfWeek =Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $endOfWeek =  Carbon::now()->endOfWeek(Carbon::THURSDAY);
        $arrayIsTotalHoursLessThanPerWeek=$this->ContractHours($auth ,$startOfWeek,$endOfWeek);
        $isTotalHoursLessThanPerWeek=isTotalHoursLessThan(sumTimes($arrayIsTotalHoursLessThanPerWeek['timer']),$arrayIsTotalHoursLessThanPerWeek['contract']->working_hours_per_week);


        // monthly  working Hours
        $startOfMonth =Carbon::now()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfMonth =  Carbon::now()->endOfMonth()->endOfWeek(Carbon::THURSDAY);
        $arrayIsTotalHoursLessThanPerMonth=$this->ContractHours($auth ,$startOfMonth,$endOfMonth);
        $isTotalHoursLessThanPerMonth=isTotalHoursLessThan(sumTimes($arrayIsTotalHoursLessThanPerMonth['timer']),$arrayIsTotalHoursLessThanPerMonth['contract']->working_hours);


        return [
        'sumTimesPerContract'=>sumTimes($array['timer']),
        'isTotalHoursLessThanPerContract'=>$isTotalHoursLessThanPerContract,

        'sumTimesPerDay'=>sumTimes($arrayIsTotalHoursLessThanPerDay['timer']),
        'isTotalHoursLessThanPerDay'=>$isTotalHoursLessThanPerDay,

        'sumTimesPerWeek'=>sumTimes($arrayIsTotalHoursLessThanPerWeek['timer']),
        'isTotalHoursLessThanPerWeek'=>$isTotalHoursLessThanPerWeek,

        'sumTimesPerMonth'=>sumTimes($arrayIsTotalHoursLessThanPerMonth['timer']),
        'isTotalHoursLessThanPerMonth'=>$isTotalHoursLessThanPerMonth,
        ] ;

    }

}
