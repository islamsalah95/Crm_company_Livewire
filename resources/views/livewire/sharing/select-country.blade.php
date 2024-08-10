

 <div class="position-relative" >
    <select
         wire:model.live="select"
         wire:change="countryChanged()"
         class="form-select"
         >
         @foreach ($countries as $countrie)
             <option value="{{ $countrie['id'] }}">{{ $countrie['name'] }}</option>
         @endforeach
     </select>
     </div>
