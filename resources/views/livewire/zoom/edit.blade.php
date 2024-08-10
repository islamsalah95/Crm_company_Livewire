
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

        <form wire:submit="store" >
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="topic">Topic</label>
                        <input type="text" class="form-control" id="topic" wire:model.live="topic" >
                        @error('topic') <span class="error">{{ $message }}</span> @enderror

                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="datetime-local" class="form-control" id="start_time" wire:model.live="start_time" >
                        @error('start_time') <span class="error">{{ $message }}</span> @enderror

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="duration">Duration (minutes)</label>
                        <input type="number" class="form-control" id="duration" wire:model.live="duration" >
                        @error('duration') <span class="error">{{ $message }}</span> @enderror

                    </div>
                </div>
                <div class="col-md-6">
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
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update Meeting</button>
                </div>
            </div>
        </form>

    </div>
