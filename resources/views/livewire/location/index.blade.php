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
                <th>id</th>
                <th>latitude</th>
                <th>longitude</th>
                <th>ip</th>
                <th>user</th>
                <th>created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
                @foreach ($locations as $location)
                    <tr>
                        <th>{{ $location->id }}</th>
                        <th>{{ $location->latitude }}</th>
                        <th>{{ $location->longitude }}</th>
                        <th>{{ $location->ip }}</th>
                        <th>
                            @if ($location->user)
                                {{ $location->user->name }} -> {{ $location->user->email }}
                            @else
                                No user
                            @endif
                        </th>
                        <th>{{ $location->created_at }}</th>
                        <th>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" wire:click.prevent="delete({{ $location->id }})" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form-{{ $location->id }}').submit(); }">
                                            <i class="ti ti-trash me-1"></i> Delete
                                        </a>

                                        <a class="dropdown-item" href="{{ route('location.show', ['location' => $location->id]) }}">
                                            <i class="ti ti-pencil me-1"></i> Show Location
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </th>
                    </tr>
                @endforeach
        </tbody>

    </table>

    {{ $locations->links() }}


    <div style="width: 1%;"></div>
    <div style="width: 1%;"></div>
</div>
