<div class="col-sm-10">
    <select
        wire:model="select"
        wire:change="change()"
        class="form-select"
    >
        @foreach ($companies as $companie)
            <option value="{{ $companie['id'] }}"
                @if ($companie['id'] == session('AuthCompanyId')) selected @endif>
                {{ $companie['company_name'] }}
            </option>
        @endforeach
    </select>
</div>

