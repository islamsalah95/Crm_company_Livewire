<div class="card mb-4">
    <x-alert />

    <hr class="my-0">
    <div class="card-body">

      <form id="formAccountSettings" wire:submit.prevent="saveContact" method="POST" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
        
        <div class="row">

            <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="start_date" class="col-form-label">Start Date</label>
                <input
                type="date"
                class="block mt-1 w-full form-control"
                placeholder="YYYY-MM-DD"
                id="start_date"
                wire:model.live="start_date"
                >
                @error('start_date') <span class="error">{{ $message }}</span> @enderror
    
              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="end_date" class="col-form-label">End Date</label>
                <input
                type="date"
                class="block mt-1 w-full form-control"
                placeholder="YYYY-MM-DD"
                id="end_date"
                wire:model.live="end_date"
                >
                @error('end_date') <span class="error">{{ $message }}</span> @enderror
    
              </div>



              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="EstLaborOfficeId"> رقم التعريف الخاص بوزارة العمل</label>
                <div class="col-md-10">
                  <input class="form-control" type="number" form="EstLaborOfficeId"  id="EstLaborOfficeId" wire:model.live="EstLaborOfficeId">
                  @error('EstLaborOfficeId') <span class="error">{{ $message }}</span> @enderror
    
                </div>
              </div>



              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="EstSequenceNumber"> الرقم التلسلي في وزارة العمل</label>
                <div class="col-md-10">
                  <input class="form-control" type="number" form="EstSequenceNumber"  id="EstSequenceNumber" wire:model.live="EstSequenceNumber">
                  @error('EstSequenceNumber') <span class="error">{{ $message }}</span> @enderror
    
                </div>
              </div>



              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="hourly_rate">  السعر بالساعة : (على الأقل 25 ساعة) </label>
                <div class="col-md-10">
                  <input class="form-control" type="number" form="hourly_rate"  id="hourly_rate" wire:model.live="hourly_rate">
                  @error('hourly_rate') <span class="error">{{ $message }}</span> @enderror
    
                </div>
              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="working_hours_per_day">  ساعات العمل في اليوم: (لا تتجاوز 12 ساعة في اليوم) </label>
                <div class="col-md-10">
                  <input class="form-control" type="number" form="working_hours_per_day"  id="working_hours_per_day" wire:model.live="working_hours_per_day">
                  @error('working_hours_per_day') <span class="error">{{ $message }}</span> @enderror
    
                </div>
              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="working_hours_per_week">  ساعات العمل في الأسبوع: (لا تتجاوز 24 ساعة أسبوعًا) </label>
                <div class="col-md-10">
                  <input class="form-control" type="number" form="working_hours_per_week"  id="working_hours_per_week" wire:model.live="working_hours_per_week">
                  @error('working_hours_per_week') <span class="error">{{ $message }}</span> @enderror
    
                </div>
              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="working_hours">  إجمالي ساعات العمل: (لا تتجاوز 95 ساعة شهريا) </label>
                <div class="col-md-10">
                  <input class="form-control" type="number" form="working_hours"  id="working_hours" wire:model.live="working_hours">
                  @error('working_hours') <span class="error">{{ $message }}</span> @enderror
                </div>
              </div>




              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="is_molTWC">  هل يتبع لخدمة العمل عن بعد</label>
                <div class="position-relative" data-select2-id="49">
                <select id="is_molTWC" wire:model.live="is_molTWC" class="select2 form-select select2-hidden-accessible" data-select2-id="is_molTWC" tabindex="-1" aria-hidden="true">
                    <option value="0">no</option>
                    <option value="1">yes</option>
                </select>
               </div>
               @error('is_molTWC') <span class="error">{{ $message }}</span> @enderror
    
              </div>


        </div>
        <div class="mt-2">
          <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
          <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
        </div>
      <input type="hidden">
    </form>
    </div>
    <!-- /Account -->
  </div>

