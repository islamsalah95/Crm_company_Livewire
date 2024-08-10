<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskService
{

    protected $Task;

    public function __construct(Task $Task)
    {
        $this->Task = $Task;
    }



    public function tasks($companyAuthUserId,$search,$paginate=5)
    {


        return Task::
            where('company_id',$companyAuthUserId)->
            where('name', 'like', '%' . $search. '%')->
            paginate($paginate);

    }



        /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {

        $Task= new Task();
        $Task->name=$request['name'];
        $Task->project_id=$request['project_id'];
        $Task->company_id=$request['company_id'];
        $Task->start_date=$request['start_date'];
        $Task->end_date=$request['end_date'];
        $Task->type=$request['type'];
        $Task->save();

       if ($Task->id && $request['user_id'] !==[] ) {
           $Task->users()->attach($request['user_id']);
       }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($Task)
    {
        $Task=Task::findOrfail($Task);
        return  $Task->delete() ;
    }

    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
        } else {
            return Auth::user()->company_id;
        }
    }

    public function tasksUser($privates ,$selectProject)
    {


        $array = [];

        foreach ($privates as $private) {
            if ($private->company_id == $this->AuthCompanyId() && $private->type == 'private' && $private->project_id == $selectProject) {
                $array[] = $private;
            }
        }

        $publicTasks = Task::where('company_id', $this->AuthCompanyId())->where('type', 'public')
            ->get();
        foreach ($publicTasks as $publicTask) {
            if ($publicTask->company_id == $this->AuthCompanyId() && $publicTask->type == 'public' && $publicTask->project_id == $selectProject) {

                $array[] = $publicTask;
            }
        }

        return    $array;
    }

}
