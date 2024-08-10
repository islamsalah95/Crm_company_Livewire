<div class="row">
    <div class="table-container card">
        <div class="table-responsive text-nowrap mb-3" id="myTabel">
            <div class="card-header flex-column flex-md-row" id="hide">
                <div class="dt-action-buttons text-end pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap">
                        <div class="btn-group">
                            <button onclick="printDiv()"
                                class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2"
                                tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog"
                                aria-expanded="false"><span><i class="ti ti-file-export me-sm-1">
                                    </i> <span class="d-none d-sm-inline-block">Print</span></span><span
                                    class="dt-down-arrow"></span>
                            </button>
                        </div>

                        <div class="btn-group">
                            <button onclick="exportToExcel('Emplys')"
                                class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-2"
                                tabindex="0" aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog"
                                aria-expanded="false"><span><i class="ti ti-file-export me-sm-1">
                                    </i> <span class="d-none d-sm-inline-block">Export</span></span><span
                                    class="dt-down-arrow"></span>
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
                                <select wire:model.live="paginate" name="DataTables_Table_0_length"
                                    aria-controls="DataTables_Table_0" class="form-select">
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
                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:
                                <input type="search" wire:model.live="search" class="form-control" placeholder=""
                                    aria-controls="DataTables_Table_0">
                            </label></div>
                    </div>
                </div>
            </div>


            <table class="datatables-basic table dataTable no-footer dtr-column collapsed" id="excelTable">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>today</th>
                        <th>Weekly</th>
                        <th>monthly</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($reports as $report)
                        <tr>
                            <th> {{ $report->id }}</th>
                            <th> {{ $report->name }}</th>
                            <th> {{ $report->email }}</th>
                            @if ($report->report !== '')
                                <th> {{ $report->report['sumTimesPerDay'] }}</th>
                                <th> {{ $report->report['sumTimesPerWeek'] }}</th>
                                <th> {{ $report->report['sumTimesPerMonth'] }}</th>
                                <th> {{ $report->report['sumTimesPerContract'] }}</th>
                                <th>
                                    <a class="dropdown-item"
                                        href="{{ route('crm.employ.report', ['user' => $report->id]) }}">
                                        <i class="ti ti-pencil me-1"></i>Working Hours
                                    </a>

                                </th>
                            @else
                                <th><i class="fas fa-times-circle"></i> </th>
                                <th><i class="fas fa-times-circle"></i> </th>
                                <th><i class="fas fa-times-circle"></i> </th>
                                <th><i class="fas fa-times-circle"></i> </th>
                                <th>
                                <span class="badge bg-label-primary me-1">
                                    <i class="fas fa-times-circle"></i> <!-- Font Awesome icon for inactive status -->
                                    Expired Contract
                                </span>
                                </th>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>


            {{ $reports->links() }}


            <div style="width: 1%;"></div>
            <div style="width: 1%;"></div>
        </div>
    </div>
</div>
