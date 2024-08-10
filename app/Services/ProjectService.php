<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;


class ProjectService
{

    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }



    public function projects($companyAuthUserId,$search,$paginate=5)
    {


        return Project::
            where('company_id',$companyAuthUserId)->
            where('project_name', 'like', '%' . $search. '%')->
            paginate($paginate);

    }




        /**
     * Store a newly created resource in storage.
     */
    public function store($request , $select=[])
    {

        $project= new Project();
        $project->project_name=$request['project_name'];
        $project->project_type=$request['project_type'];
        $project->start_date=$request['start_date'];
        $project->end_date=$request['end_date'];
        $project->company_id =$request['company_id'];
        $project->save();

       if ($project->id && $select !==[] ) {
           $project->users()->attach($select);
       }

    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(project $project)
    // {
    //     return  $project ;
    // }


    //     /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(UpdateprojectRequest $request, project $project)
    // {
    //     $this->project::where('id',$project)->update($request->all());

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($project)
    {
        $project=Project::findOrfail($project);
        return  $project->delete() ;
    }

    public function AuthCompanyId()
    {
        if (session()->has('AuthCompanyId')) {
            return session('AuthCompanyId');
        } else {
            return Auth::user()->company_id;
        }
    }

    public function projectsUser($privates)
    {

        $array = [];

        foreach ($privates as $private) {
            if ($private->company_id == $this->AuthCompanyId() && $private->project_type == 'none') {
                $array[] = $private;
            }
        }

        $publicProjects = Project::where('company_id', $this->AuthCompanyId())->where('project_type', 'public')
            ->get();
        foreach ($publicProjects as $publicProject) {
            if ($publicProject->company_id == $this->AuthCompanyId()) {
                $array[] = $publicProject;
            }
        }

        return    $array;
    }
}
