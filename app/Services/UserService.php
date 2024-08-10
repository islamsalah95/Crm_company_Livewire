<?php
namespace App\Services;

use App\Models\User;
use App\Traits\CurrentDateTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;


class UserService
{

    protected $user;

    public function __construct()
    {
        $this->user =new User();
    }

    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
           }else{
            return Auth::user()->company_id;
            }

    }

    public function getUsersDepartment($userDepartment)
    {


        $data=  $this->user::where('department', $userDepartment)->
                where('company_id' , $this->AuthCompanyId())->
                paginate(5);

                // dd($data);

                return $data;

    }


    public function getUsersDepartmentSearch($userDepartment,$name,$paginate,$notVerify=1)
    {


        return    $this->user::where('department', $userDepartment)->
                               where('company_id' , $this->AuthCompanyId())->
                               where('status' , $notVerify)->
                               where('name', 'like', '%' . $name. '%')->
                               paginate($paginate);
    }

    public function getUsersDepartmentWithoutPagination($userDepartment,$name,$notVerify=1)
    {




        $user=User::where(function($query) {
                                    $query->where('company_id' , $this->AuthCompanyId())
                                        ->orWhere('department', '5');
                                })->
                               where('status' , $notVerify)->
                               where('name', 'like', '%' . $name. '%')->
                               get();



                               return $user;



    }

    public function show(User  $user)
    {
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request['name'];
        $user->contact1 = $request['contact1'];
        $user->birthday = $request['birthday'];
        $user->employee_national_number = $request['employee_national_number'];
        $user->city_id = $request['city_id'];
        $user->title_id = $request['title_id'];
        $user->qualification_id = $request['qualification_id'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->company_id = $request['company_id'];
        $user->department = $request['department'];
        $user->joining_date = CurrentDateTrait::getDate_Y_m_d_H_i_s();
        $user->create_date = CurrentDateTrait::getDate_Y_m_d_H_i_s();
        $user->save();
        return $user  ;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update($request, User  $user)
    {
        return  $user->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User  $user)
    {
        return $user->delete();
    }

    public function block(User  $user)
    {

        if($user->status == 0){
            $user->status = 1;
        }
        else{
            $user->status = 0;
        }
        $user->save();
        return  $user;
    }

    public function usersCompany()
    {

        $authCompanyId=$this->AuthCompanyId();
        return User::where('company_id', $authCompanyId)->paginate(5);

     }
}
