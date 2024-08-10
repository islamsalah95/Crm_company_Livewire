<div class="row">
    <div class="table-container card">
        <div class="table-responsive text-nowrap mb-3" id="myTabel">
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
                                <select wire:model.live="paginate" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                                    <option value="5" selected>5</option>
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
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label>Start
                                <input type="date" wire:model.live="startFrom" wire:change="changeStartAndEnd" class="form-control" placeholder="" aria-controls="DataTables_Table_0">
                            </label>
                        </div>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label>End
                                <input type="date" wire:model.live="endFrom" wire:change="changeStartAndEnd" class="form-control" placeholder="" aria-controls="DataTables_Table_0">
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">Select Time</label>
                            <select wire:change="changeTime" wire:model.live="select" id="defaultSelect" class="form-select">
                              <option value="" selected>Default select</option>
                              <option value="today">today</option>
                              <option value="weekly">weekly</option>
                              <option value="monthly">monthly</option>
                            </select>
                          </div>

                    </div>
                </div>
            </div>


            <table class="datatables-basic table dataTable no-footer dtr-column collapsed" id="excelTable">
                <thead>
                    <tr>
                        <th>check_in</th>
                        <th>check_out</th>
                        <th>total</th>
                        <th>project</th>
                        <th>task</th>
                        <th>created at</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($shifts as $shift)
                    <tr>
                        <th>{{ convertTime($shift->check_in)}}</th>
                        <th>{{ convertTime($shift->check_out)}}</th>
                        <th>{{ calculateTimeDifference($shift->check_in,$shift->check_out)}}</th>
                        <th>{{ $shift->project->project_name}}</th>
                        <th>{{ $shift->task->name }}</th>
                        <th>{{ $shift->created_at }}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>


            {{ $shifts->links() }}


            <div style="width: 1%;"></div>
            <div style="width: 1%;"></div>
        </div>
    </div>
</div>
