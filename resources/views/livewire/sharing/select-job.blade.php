



    <div class="position-relative">
        <select
        wire:change="jobChanged()"
        wire:model.live="title_id"
        class="form-select"
             >
             @foreach ($jobs as $job)
             <option value="{{ $job['id'] }}">{{ $job['job_ar'] }}</option>
             @endforeach
         </select>
         </div>
