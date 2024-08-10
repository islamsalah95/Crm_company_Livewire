<?php

namespace App\Livewire\Company;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\CompanyService;

class Show extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $select=5;
    public $is_valid;
    public $status;

    public function createInstanceCompanyService()
    {
            return new CompanyService(new Company );

    }

    public function companies()
    {

        return  $this->createInstanceCompanyService()->companies($this->is_valid,$this->status,$this->search,$this->select);

    }


    public function changeStatus(Company  $company)
    {

        // status 0 غير معطلة
        $this->createInstanceCompanyService()->block($company);

        session()->flash('message', 'company change Status updated.');

        $this->companies();
    }

    public function activeNewCompany(Company  $company)
    {

            //  is_valid company 1 active
            // is_valid company 0 inactive
        $this->createInstanceCompanyService()->activeNewCompany($company);

        session()->flash('message', 'active New Company success.');

        $this->companies();
    }

    public function delete(Company  $company)
    {


        $this->createInstanceCompanyService()->destroy($company);

        session()->flash('message', 'company deleted  success.');

        $this->companies();
    }

    public function render()
    {
        return view('livewire.company.show', ['companies'=> $this->companies()]);
    }
}
