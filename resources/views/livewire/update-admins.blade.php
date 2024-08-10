    <div class="card mb-4">
        <x-alert />

        <hr class="my-0">
        <div class="card-body">

          <form id="formAccountSettings" wire:submit.prevent="saveContact" method="POST" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            <div class="row">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                src="{{ asset( $emp_photo_file) }}"
                alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                <div class="button-wrapper">
                  <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="ti ti-upload d-block d-sm-none"></i>
                    <input type="file" wire:model="emp_photo_file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                    @error('emp_photo_file') <span class="error">{{ $message }}</span> @enderror
                </label>
                  <button type="button" class="btn btn-label-secondary account-image-reset mb-3 waves-effect">
                    <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                  </button>
                  <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>
              </div>
            </div>

            <div class="row">


                <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="name" class="form-label">First Name</label>
                <input class="form-control" type="text" id="name" wire:model.live="name"  autofocus="">
                @error('name') <span class="error">{{ $message }}</span> @enderror
               </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="emp_surname" class="form-label">Last Name</label>
                <input class="form-control" type="text" wire:model.live="emp_surname" id="emp_surname" >
                @error('emp_surname') <span class="error">{{ $message }}</span> @enderror

            </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="email" class="form-label">E-mail</label>
                <input class="form-control" type="text" id="email" wire:model.live="email" >
                @error('email') <span class="error">{{ $message }}</span> @enderror

            </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label" for="contact1">Phone Number</label>
                  <input type="text" id="contact1" wire:model.live="contact1" class="form-control"
                  @error('contact1') <span class="error">{{ $message }}</span> @enderror
              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="birthday" class="col-form-label">birthday</label>
                <input
                type="date"
                class="block mt-1 w-full form-control"
                placeholder="YYYY-MM-DD"
                id="birthday"
                wire:model.live="birthday"
                >
                @error('birthday') <span class="error">{{ $message }}</span> @enderror

              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="html5-number-input" id='national' class="col-md-2 col-form-label">National id</label>
                <div class="col-md-10">
                  <input class="form-control" type="number" form="national"  id="html5-number-input" wire:model.live="employee_national_number">
                  @error('employee_national_number') <span class="error">{{ $message }}</span> @enderror

                </div>
              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="qualification" class="form-label">Qualification</label>
                <div class="position-relative" data-select2-id="49">
                <select id="qualification" wire:model.live="qualification_id" class="select2 form-select select2-hidden-accessible" data-select2-id="language" tabindex="-1" aria-hidden="true">
                    <option value="" data-select2-id="">Select qualification</option>
                    @foreach ($qualifications as $qualification)
                    <option value="{{ $qualification['id'] }}" data-select2-id="{{ $qualification['id'] }}">{{ $qualification['name'] }}</option>
                    @endforeach
                </select>
               </div>
               @error('qualification_id') <span class="error">{{ $message }}</span> @enderror

              </div>


              @livewire('sharing.select-country')



              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="City" class="form-label">City</label>
                <div class="position-relative" data-select2-id="49">
                <select id="City" wire:model.live="city_id" class="select2 form-select select2-hidden-accessible" data-select2-id="language" tabindex="-1" aria-hidden="true">
                  <option value="" data-select2-id="">Select City</option>
                  @foreach ($cities as $city)
                  <option value="{{ $city['id'] }}" data-select2-id="{{ $city['id'] }}">{{ $city['name'] }}</option>
                  @endforeach
                </select>
               </div>
               @error('city_id') <span class="error">{{ $message }}</span> @enderror

              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label for="Job"  class="form-label">Job</label>
                <div class="position-relative" data-select2-id="49">
                    <input list="browsers" type="text" id='Job'  wire:model.live="search" placeholder="Search Jobs">
                    <datalist  id="browsers">
                        <option   data-select2-id="">Select Job</option>
                        @foreach ($jobs as $job)
                        <option value="{{ $job['job_ar'] }}">{{ $job['job_ar'] }}</option>
                        @endforeach
                    </datalist>
                    {{ $myJob; }}
               </div>
               @error('title_id') <span class="error">{{ $message }}</span> @enderror

              </div>


              <div class="mb-3 col-md-6 fv-plugins-icon-container">
                <label class="form-label"  for="newPassword">New Password</label>
                <div class="input-group input-group-merge has-validation">
                  <input class="form-control" wire:model.live="password" type="password" id="newPassword" name="newPassword" placeholder="············">
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
                @error('password') <span class="error">{{ $message }}</span> @enderror
              </div>

            </div>
            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
              <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
            </div>
          <input type="hidden"></form>
        </div>
        <!-- /Account -->
      </div>
