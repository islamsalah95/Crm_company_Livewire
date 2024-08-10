<div class="table-responsive text-nowrap" id="myTabel">
    <x-alert />
    <div class="card-header flex-column flex-md-row" id="hide">
        <div class="dt-action-buttons text-end pt-3 pt-md-0">
            <div class="dt-buttons btn-group flex-wrap">
                <div class="btn-group">
                    <button onclick="printDiv()" class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-file-export me-sm-1">
                            </i> <span class="d-none d-sm-inline-block">Print</span></span><span class="dt-down-arrow"></span>
                    </button>
                </div>

                <div class="btn-group">
                    <button onclick="exportToExcel('Emplys')" class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2" tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-file-export me-sm-1">
                            </i> <span class="d-none d-sm-inline-block">Export</span></span><span class="dt-down-arrow"></span>
                    </button>
                </div>

                <div class="btn-group">
                    <a href="{{ route('companies.create',['country'=>66]) }}" class="btn btn-secondary create-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                        <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New Record</span></span>
                    </a>
                </div>

                <div class="btn-group" style="width: 10px;">
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="DataTables_Table_0_length">
                    <label>Show
                        <select wire:model.live="select" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                            <option value="5">5</option>
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="75">75</option>
                            <option value="100">100</option>
                        </select> entries
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:
                        <input type="search" wire:model.live="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0">
                    </label></div>
            </div>
        </div>
    </div>


    <table class="datatables-basic table dataTable no-footer dtr-column collapsed" id="excelTable">
        <thead>
            <tr>
                <th>company_name</th>
                <th>company_address</th>
                <th>company_website</th>
                <th>country</th>
                <th>state</th>
                <th>city</th>
                <th>timezone</th>
                <th>create_on</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($companies as $company)
            <tr>
                <th>{{ $company['company_name'] }}</th>
                <th>{{ $company['company_address'] }}</th>
                <th>{{ $company['company_website'] }}</th>
                <th>{{ $company->myCountry->name }}</th>
                <th>{{ $company->myState->name  }}</th>
                <th>{{ $company->myCity->name}}</th>
                <th>{{ $company->myTimezone->name }}</th>
                <th>{{ $company['create_on'] }}</th>
                {{--  status 0 غير معطلة  --}}
                <th>
                @if ($company['status']==0)
                <span class="badge bg-label-primary me-1">
                    <i class="fas fa-check-circle"></i> <!-- Font Awesome icon for active status -->
                    Active
                </span>
                @else
                <span class="badge bg-label-primary me-1">
                    <i class="fas fa-times-circle"></i> <!-- Font Awesome icon for inactive status -->
                    Inactive
                </span>
                @endif
            </th>


                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            {{--  status 0 غير معطلة  --}}
                            <a class="dropdown-item" href="#" wire:click.prevent="changeStatus({{ $company->id }})" onclick="event.preventDefault(); if(confirm('Are you sure you want to change this user?')) { document.getElementById('block-form-{{ $company->id }}').submit(); }">
                                <i class="fab fa-500px mb-2"></i> Change Status
                            </a>

                            {{--  is_valid company 1 active
                            is_valid company 0 inactive   --}}
                            @if($company->is_valid==0 )
                            <a class="dropdown-item" href="#" wire:click.prevent="activeNewCompany({{ $company->id }})" onclick="event.preventDefault(); if(confirm('Are you sure you want to active New Company this user?')) { document.getElementById('block-form-{{ $company->id }}').submit(); }">
                                <i class="fab fa-500px mb-2"></i> active New Company
                            </a>
                            @endif

                            <a class="dropdown-item" href="#" wire:click.prevent="delete({{ $company->id }})" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $company->id }}').submit(); }">
                                <i class="ti ti-trash me-1"></i> Delete
                            </a>

                            <a class="dropdown-item" href="{{ route('companies.edit', ['company' =>$company->id]) }}">
                                <i class="ti ti-pencil me-1"></i> Edit
                            </a>

                            {{--





                            <a class="dropdown-item" href="#" wire:click.prevent="changeStatus({{ $employ->id }})" onclick="event.preventDefault(); if(confirm('Are you sure you want to change this user?')) { document.getElementById('block-form-{{ $employ->id }}').submit(); }">
                                <i class="fab fa-500px mb-2"></i> Change Status
                            </a>

                            <a class="dropdown-item" href="{{ route('contracts.index', ['user' => $employ->id]) }}">
                                <i class="ti ti-pencil me-1"></i> Show Contract
                            </a>

                            @if (!$employ->expiration($employ['id']))
                            <a class="dropdown-item" href="{{ route('contracts.create', ['user' => $employ->id]) }}">
                                <i class="ti ti-pencil me-1"></i> add Contract
                            </a>
                            @endif  --}}


                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $companies->links() }}


    <div style="width: 1%;"></div>
    <div style="width: 1%;"></div>
</div>
