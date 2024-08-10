
<div class="position-relative">
    <select
    wire:change="qualificationChanged()"
     wire:model.live="qualification_id"
     class="form-select"
         >
         <option value="" data-select2-id="">Select qualification</option>
         @foreach ($qualifications as $qualification)
             <option value="{{ $qualification['id'] }}"
                 data-select2-id="{{ $qualification['id'] }}"
                 >
                 {{ $qualification['name'] }}</option>
         @endforeach
     </select>
 </div>
