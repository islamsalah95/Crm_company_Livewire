<div class="container mt-5">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">{{ translate('Meeting') }}/</span>{{ translate('Create') }}</h4>
    <div class="card p-4">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit="store" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="topic">Topic</label>
                        <input type="text" class="form-control" id="topic" wire:model.live="topic" value="Lecture abdala: 823">
                        @error('topic') <span class="error">{{ $message }}</span> @enderror

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" class="form-control" id="start_time" wire:model.live="start_time" value="2024-06-07T10:48:00">
                        @error('start_time') <span class="error">{{ $message }}</span> @enderror

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="duration">Duration (minutes)</label>
                        <input type="number" class="form-control" id="duration" wire:model.live="duration" value="20">
                        @error('duration') <span class="error">{{ $message }}</span> @enderror

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="timezone">Timezone</label>
                        <select class="form-control" id="timezone" wire:model.live="timezone">
                            @foreach($timezones as $timezone)
                            <option value="{{ $timezone->name }}">{{ $timezone->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('timezone') <span class="error">{{ $message }}</span> @enderror

                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="timezone">Status</label>
                        <select class="form-control" id="status" wire:model.live="status">
                            <option value="1" selected>Public</option>
                            <option value="0">Private</option>
                        </select>
                    </div>

                </div>

                @if ($status==0)

                <div class="row">
                    <div class="table-responsive text-nowrap" id="myTabel">
                        <table class="datatables-basic table dataTable no-footer dtr-column collapsed" id="excelTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>select</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($users as $user)
                                <tr>
                                    <th>{{ $user['id'] }}</th>
                                    <th>{{ $user['name'] }}</th>
                                    <th>{{ $user['email'] }}</th>
                                    <th>
                                    <div class="form-check">
                                        <input class="form-check-input" wire:click="addTodo({{ $user->id }})"  onchange="selectUser()"  id="user{{ $user->id }}"
                                         @if (in_array($user->id, $selectUsers)) checked @endif type="checkbox">
                                      </div>
                                    </th>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                        <div style="width: 1%;"></div>
                        <div style="width: 1%;"></div>
                    </div>

                </div>

                @endif

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mt-3">Create Meeting</button>
                </div>
            </div>
        </form>



    </div>




</div>
