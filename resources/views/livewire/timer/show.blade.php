



<div>


    <div>
        <div class="card mb-3">
            @if($isStarted == null)
            <div class="card-body">
                <div class="mb-3">
                    <label for="projectSelect" class="form-label">Select Project</label>
                    <select wire:model.live="selectProject" id="projectSelect" class="form-select">
                        <option value=''>Select Project</option>
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                        @endforeach
                    </select>
                    @error('selectProject') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="taskSelect" class="form-label">Select Task</label>
                    <select wire:model.live="selectTask" id="taskSelect" class="form-select">
                        <option value=''>Select Task</option>
                        @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->name }}</option>
                        @endforeach
                    </select>
                    @error('selectTask') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <button type="button" onclick="startTimer()" wire:click="start()" class="btn btn-success">Start</button>
                </div>
            </div>
            @else
            <div class="card-body">
                <div class="mb-3">
                    <button type="button" onclick="stopTimer()" wire:click="end()" class="btn btn-danger">End</button>
                </div>
            </div>
            @endif

            <div class="card-body">
                @if($isStarted !== null)
                <p>Started Time: {{ convertTime($isStarted->check_in) }}</p>
                @endif
                @if ($endTime)
                <p>End Time: {{ convertTime($endTime) }}</p>
                @endif
                @if ($total)
                <p>Total: {{ $total }}</p>
                @endif
            </div>

            @if($demo==true || $isStarted)
            <div class="card-body">
                <p id="demo"></p>
            </div>
            @endif
        </div>
        <x-alert />

    </div>





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
                        <th>check_in</th>
                        <th>check_out</th>
                        <th>total</th>
                        <th>project</th>
                        <th>task</th>
                        <th>approved_time</th>
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
                        <th>{{ $shift->approved_time }}</th>
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


@script
<script>

    $wire.on('timer', () => {
        startTimer();
    });

    let timerInterval; // Variable to hold the timer interval ID
    let startTime; // Variable to store the start time

    function startTimer() {
        startTime = {{ $isStarted ? $isStarted->check_in : time()}};
        timerInterval = setInterval(updateTimer, 1000);
    }

    function stopTimer() {
        clearInterval(timerInterval);
        document.getElementById("demo").style.display = "none";

    }

    function updateTimer() {

        const currentTime = Math.floor(Date.now() / 1000); // Current time in seconds
        const elapsedTime = currentTime - startTime; // Calculate elapsed time in seconds
        // Calculate hours, minutes, and seconds
        const hours = Math.floor(elapsedTime / 3600);
        const minutes = Math.floor((elapsedTime % 3600) / 60);
        const seconds = elapsedTime % 60;
        // Format the time as HH:MM:SS
        const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        // Update the HTML element with the formatted time
        document.getElementById("demo").innerHTML = formattedTime;
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            async (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };

                try {
                    const response = await fetch('https://api.ipify.org?format=json');
                    const data = await response.json();
                    pos.ip = data.ip;
                } catch (error) {
                    console.error('Error fetching IP address:', error);
                }
                console.log(pos)
                $wire.dispatch('location-created', { location: pos });
            },
            (error) => {
                handleLocationError(true, infoWindow, map.getCenter());
            },
        );
    } else {
        handleLocationError(false, infoWindow, map.getCenter());
    }
</script>
@endscript
