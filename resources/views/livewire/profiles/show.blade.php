<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('User Profile ') }}/</span>{{ translate('Profile') }}</h4>
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img
                            <img src="{{auth()->user()->getFirstMediaUrl('employs') }}"
                            alt="{{auth()->user()->getFirstMediaUrl('employs') }}"
                              class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>{{ $authUser->name }}</h4>
                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class="ti ti-color-swatch"></i> {{ $authUser->title->job_ar }}
                                        </li>
                                        <li class="list-inline-item d-flex gap-1"><i class="ti ti-map-pin"></i> {{ $authUser->city->name }}</li>
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class="ti ti-calendar"></i> {{ $authUser->created_at }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light">
                                    <i class="ti ti-check me-1"></i>Connected
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <div class="row">
            <div class="col-md-6 mb-4">
                <!-- About User contract-->
                <div class="card h-100">
                    <div class="card-body">
                        <small class="card-text text-uppercase">Contract</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <span>Working hours:</span> <span>{{ $contract->working_hours }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <span>Working hours per day:</span> <span>{{ $contract->working_hours_per_day }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <span>Working hours per week:</span> <span>{{ $contract->working_hours_per_week }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <span>Hourly rate:</span> <span>{{ $contract->hourly_rate }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <span>Start date:</span> <span>{{ $contract->start_date }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <span>End date:</span> <span>{{ $contract->end_date }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <span>Created at:</span> <span>{{ $contract->created_at }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <span style="color: green">Total Contract Hours Salary:</span> <span>{{ $totalContractHoursSalary }} SR</span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase">Contacts</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Contact:</span>
                                <span>{{ $authUser->contact1 }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                                <span>{{ $authUser->email }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ About User -->
            </div>

            @php
            $timeDataTotal = calculateTimePercent($contract->working_hours, $totalContractHours['sumTimesPerContract']);
            $percentTotal = $timeDataTotal['percentage'];
            @endphp
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <h3 class="mb-0">{{ round($percentTotal, 2) }} %</h3>
                    <canvas id="myChart" style="width:100%; height:100%;"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            @php
            $timeDataToday = calculateTimePercent($contract->working_hours_per_day, $totalContractHours['sumTimesPerDay']);
            $percentageToday = $timeDataToday['percentage'];
            @endphp

            <div class="col-lg-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <small class="d-block mb-1 text-muted">Today</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="d-flex gap-2 align-items-center mb-2">
                                    <p class="mb-0">Hours: {{ $timeDataToday['remainingTime'] }}</p>
                                </div>
                                <h5 class="mb-0 pt-1 text-nowrap">{{ round($percentageToday, 2) }}%</h5>
                            </div>
                            <div class="col-4">
                                <div class="divider divider-vertical">
                                    <div class="divider-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                            <div class="progress w-100" style="height: 8px">
                                <div class="progress-bar bg-info" style="width: {{ $percentageToday }}%" role="progressbar" aria-valuenow="{{ $percentageToday }}" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-primary" style="width: {{ 100 - $percentageToday }}%" role="progressbar" aria-valuenow="{{ 100 - $percentageToday }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
            $timeDataWeekly = calculateTimePercent($contract->working_hours_per_week, $totalContractHours['sumTimesPerWeek']);
            $percentageWeekly = $timeDataWeekly['percentage'];
            @endphp

            <div class="col-lg-6 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <small class="d-block mb-1 text-muted">Weekly</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="d-flex gap-2 align-items-center mb-2">
                                    <p class="mb-0">Hours: {{ $timeDataWeekly['remainingTime'] }}</p>
                                </div>
                                <h5 class="mb-0 pt-1 text-nowrap">{{ round($percentageWeekly, 2) }}%</h5>
                            </div>
                            <div class="col-4">
                                <div class="divider divider-vertical">
                                    <div class="divider-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mt-4">
                            <div class="progress w-100" style="height: 8px">
                                <div class="progress-bar bg-info" style="width: {{ $percentageWeekly }}%" role="progressbar" aria-valuenow="{{ $percentageWeekly }}" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-primary" style="width: {{ 100 - $percentageWeekly }}%" role="progressbar" aria-valuenow="{{ 100 - $percentageWeekly }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @livewire('profiles.report-tabel',['authUser'=>$authUser])
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
    var xValues = ["Remaining Hours: <?php echo $timeDataTotal['remainingTime']; ?>", "Total Hours: <?php echo $timeDataTotal['totalTime']; ?>"];
    var yValues = [<?php echo $percentTotal; ?>, <?php echo round((100 - $percentTotal), 2); ?>];
    var barColors = [
        "#b91d47",
        "#00aba9"
    ];

    new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
    });
</script>
