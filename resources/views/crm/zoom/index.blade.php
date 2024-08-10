@extends('layouts.crm')
@extends('layouts.crm')
@section('title')
Meeting Show
@endsection

@section('Content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Meeting') }}/</span>{{ translate('Show') }}</h4>

<div class="table-responsive text-nowrap" id="myTabel">
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
                    <a href="{{ route('zoom.create') }}" class="btn btn-secondary create-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                        <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Meeting Create</span></span>
                    </a>
                </div>

                <div class="btn-group" style="width: 10px;">
                </div>

            </div>
        </div>

    </div>


    <div class="container mt-5">
        <div class="card">
            <div class="table-responsive">
                <table class="datatables-basic table dataTable no-footer dtr-column collapsed" id="excelTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Host ID</th>
                            <th>Topic</th>
                            <th>Type</th>
                            <th>Start Time</th>
                            <th>Duration</th>
                            <th>Timezone</th>
                            <th>Created At</th>
                            <th>Join URL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meetings as $meeting)
                        <tr>
                            <td>{{ $meeting['id'] }}</td>
                            <td>{{ $meeting['host_id'] }}</td>
                            <td>{{ $meeting['topic'] }}</td>
                            <td>{{ $meeting['type'] }}</td>
                            <td>{{ $meeting['start_time'] }}</td>
                            <td>{{ $meeting['duration'] }}</td>
                            <td>{{ $meeting['timezone'] }}</td>
                            <td>{{ $meeting['created_at'] }}</td>
                            <td><a href="{{ $meeting['join_url'] }}" target="_blank">Join Meeting</a></td>
                            <td style="display: flex;">
                                <div style="margin-right: 10px;">
                                    <form action="{{ route('zoom.delete', $meeting['id']) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                                <div>
                                    <a href="{{ route('zoom.edit', ['meeting' => $meeting['id'] ]) }}" class="btn btn-primary btn-sm">Edit</a>
                                </div>

                                <div>
                                    <a href="{{ route('zoom.view', $meeting['id']) }}" class="btn btn-primary btn-sm">view</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div style="width: 1%;"></div>
    <div style="width: 1%;"></div>
</div>

@endsection



