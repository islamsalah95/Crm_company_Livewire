<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Services\UserService;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{

        protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function superAdmins()
    {
        $admins = $this->userService->getUsersDepartment('5');

        return view('crm.admins.adminsShow',['admins'=>$admins]);
    }


    public function admins()
    {


        return view('crm.admins.adminsShow');
    }


    public function registerEmploys()
    {
        return view('crm.employs.registerEmploysShow');

    }

    public function employs()
    {
        return view('crm.employs.employsShow');

    }

    public function freelancers()
    {
        $this->userService->getUsersDepartment('3');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('crm.admins.adminsCreate');

    }

    public function createEmploys()
    {

        return view('crm.employs.employsCreate');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->userService->show($user);
        $companies=Company::all();
        return view('crm.usersUpdate',['user'=>$user,'companies'=>$companies]);

    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,User $user)
    {
        $this->userService->update($request , $user);
        Session::flash('success', 'User update successfully');
        return redirect()->back();
    }

    public function block(User $user)
    {
        $this->userService->block($user);
        Session::flash('success', 'User Change Status successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        Session::flash('success', 'User destroy successfully');
        return redirect()->back();
    }

}
