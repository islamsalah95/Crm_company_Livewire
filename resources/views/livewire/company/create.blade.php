<div class="col-12 mb-4">
    <x-alert />

    {{--  @if ($errors->has('default'))
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif  --}}

    <div class="bs-stepper wizard-numbered mt-2">
      <div class="bs-stepper-header">
        <div class="step crossed" data-target="#account-details">
          <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-circle">1</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Country</span>
              <span class="bs-stepper-subtitle">Setup Country</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="ti ti-chevron-right"></i>
        </div>
        <div class="step crossed" data-target="#personal-info">
          <button type="button" class="step-trigger" aria-selected="false">
            <span class="bs-stepper-circle">2</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Company</span>
              <span class="bs-stepper-subtitle">Add Company</span>
            </span>
          </button>
        </div>
        <div class="line">
          <i class="ti ti-chevron-right"></i>
        </div>
        <div class="step active" data-target="#social-links">
          <button type="button" class="step-trigger" aria-selected="true">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Admin</span>
              <span class="bs-stepper-subtitle">Add Admin</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form wire:submit="save"  onsubmit="return false">
          <!-- Country -->
          <div id="account-details" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Country</h6>
              <small>Enter Your Country.</small>
            </div>
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="country" class="form-label">Country</label>
                    <div class="position-relative" >
                       <select
                            wire:model.live="country"
                            wire:change="countryChanged()"
                            class="form-select"
                            >
                            @foreach ($myCountries as $myCountry)
                                <option value="{{ $myCountry['id'] }}">{{ $myCountry['name'] }}</option>
                            @endforeach
                        </select>
                        </div>
                        @error('country') <span class="error">{{ $message }}</span> @enderror
                 </div>

              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev waves-effect" disabled="">
                  <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next waves-effect waves-light">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="ti ti-arrow-right"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Company -->
          <div id="personal-info" class="content">
            <div class="content-header mb-3">
              <h6 class="mb-0">Company </h6>
              <small>Enter Your Company.</small>
            </div>
            <div class="row g-3">



                <div class="col-sm-6">
                    <label for="logo" class="form-label">Logo</label>
                    <input class="form-control" wire:model="logo" type="file" id="logo">
                    @error('logo') <span class="error">{{ $message }}</span> @enderror
                </div>


                <div class="col-sm-6">
                    <label class="form-label" for="company_name">Company Name</label>
                    <input type="text" id="company_name" class="form-control" wire:model="company_name">
                    @error('company_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-sm-6">
                    <label class="form-label" for="username">Company Website</label>
                    <input type="text" id="company_website" class="form-control"
                    wire:model="company_website">
                        @error('company_website') <span class="error">{{ $message }}</span> @enderror

                </div>


                <div class="col-sm-6">
                    <label class="form-label" for="company_address">Company Address</label>
                    <input type="text" id="company_address" class="form-control"
                    wire:model="company_address"
                    >
                        @error('company_address') <span class="error">{{ $message }}</span> @enderror

                </div>

                <div class="col-sm-6">
                    <label class="form-label" for="company_email">Company Email</label>
                    <input
                    type="email"
                    id="company_email"
                    class="form-control"
                    wire:model="company_email"
                        >
                        @error('company_email') <span class="error">{{ $message }}</span> @enderror

                </div>

             <div class="col-sm-6">
                <label class="form-label" for="telephone1">Company telephone</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon11">+{{ $phoneCode }}</span>
                    <input type="number" id="telephone1" class="form-control" wire:model="telephone1" aria-describedby="basic-addon11">
                    @error('telephone1') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

                {{--  <div class="col-sm-6">
                        <label class="form-label" for="telephone1">Company telephone</label>
                        <span class="input-group-text" id="basic-addon11">+{{ $phoneCode }}</span>
                        <input type="number" id="telephone1" class="form-control" wire:model="telephone1" aria-describedby="basic-addon11">
                        @error('telephone1') <span class="error">{{ $message }}</span> @enderror

                </div>  --}}

                <div class="col-sm-6">
                    <label class="form-label" for="zip">zip</label>
                    <input type="number" id="zip" class="form-control" wire:model="zip">
                    @error('zip') <span class="error">{{ $message }}</span> @enderror

                </div>


                <div class="col-sm-6">
                    <label for="currency" class="form-label">Currency</label>
                    <div class="position-relative">
                       <select
                       wire:model="company_currencysymbol"
                       class="form-select"
                       >
                            @foreach ( $currency as $currenc )
                            <option selected value="{{ $currenc['id'] }}" > {{ $currenc['name']  }} {{ $currenc['id']  }} </option>
                            @endforeach
                        </select>
                        </div>
                 @error('company_currencysymbol') <span class="error">{{ $message }}</span> @enderror
                </div>



                <div class="col-sm-6">
                    <label for="state" class="form-label">State</label>
                    <div class="position-relative">
                       <select
                       wire:model="state"
                       class="form-select"
                            >
                            @foreach ( $countryInfos[0]['states'] as $state )
                            <option value="{{ $state['id'] }}">{{ $state['name'] }}</option>
                            @endforeach
                         </select>
                    </div>
                        @error('state') <span class="error">{{ $message }}</span> @enderror
                </div>




                <div class="col-sm-6">
                    <label for="city" class="form-label">city</label>
                    <div class="position-relative">
                       <select wire:model="city"
                       class="form-select"
                            >
                            @foreach ( $countryInfos[0]['cities'] as $citie )
                            <option value="{{ $citie['id'] }}">{{ $citie['name'] }}</option>
                            @endforeach
                        </select>
                     </div>
                        @error('city') <span class="error">{{ $message }}</span> @enderror
               </div>




                    <div class="col-sm-6" data-select2-id="45">
                        <label for="timezone" class="form-label">timezone {{ $timezone }}</label>
                        <div class="position-relative" >
                           <select
                           wire:model="timezone"
                           class="form-select"

                               >
                                <option selected value="{{ $countryInfos[0]['timezones'][0]['id']  }}">{{ $countryInfos[0]['timezones'][0]['name'] }}{{ $countryInfos[0]['timezones'][0]['id']  }}</option>
                            </select>
                         </div>
                            @error('timezone') <span class="error">{{ $message }}</span> @enderror
                   </div>
              <div class="col-12 d-flex justify-content-between">
                <button class="btn btn-label-secondary btn-prev waves-effect">
                  <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                  <span class="align-middle d-sm-inline-block d-none">Previous</span>
                </button>
                <button class="btn btn-primary btn-next waves-effect waves-light">
                  <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                  <i class="ti ti-arrow-right"></i>
                </button>
              </div>
            </div>
          </div>
          <!-- Admin -->
          <div id="social-links" class="content active dstepper-block">
            <div class="content-header mb-3">
              <h6 class="mb-0">Admin</h6>
              <small>Enter Your Admin.</small>
            </div>

            <div class="col-sm-6">
                <label for="logo" class="form-label">Profile</label>
                <input class="form-control" wire:model="emp_photo_file" type="file" id="emp_photo_file">
                @error('emp_photo_file') <span class="error">{{ $message }}</span> @enderror
            </div>


            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="name" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="name" wire:model.live="name"
                        autofocus="">
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <label for="emp_surname" class="form-label">Last Name</label>
                    <input class="form-control" type="text" wire:model.live="emp_surname"
                        id="emp_surname">
                    @error('emp_surname')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>


                <div class="col-sm-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="text" id="email" wire:model.live="email">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>



                   <div class="col-sm-6">
                    <label class="form-label" for="contact1">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon11">+{{ $phoneCode }}</span>
                        <input type="number" id="contact1" class="form-control" wire:model="contact1" aria-describedby="basic-addon11">
                        @error('contact1') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>


                    <div class="col-sm-6">
                        <label for="birthday" class="col-form-label">birthday</label>
                        <input type="date" class="block mt-1 w-full form-control" placeholder="YYYY-MM-DD"
                            id="birthday" wire:model.live="birthday">
                        @error('birthday')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="col-sm-6">
                        <label for="html5-number-input" id='national'
                            class="col-md-2 col-form-label">National id</label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" form="national"
                                id="html5-number-input" wire:model.live="employee_national_number">
                            @error('employee_national_number')
                                <span class="error">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>


                    <div class="col-sm-6">
                        <label for="qualification" class="form-label">Qualification</label>
                        <div class="position-relative">
                           <select
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
                        @error('qualification_id')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="col-sm-6">
                        <label for="City" class="form-label">City</label>
                        <div class="position-relative">
                           <select
                           wire:model.live="city_id"
                           class="form-select"
                                >
                                <option value="" data-select2-id="">Select City</option>
                                @foreach ($countryInfos[0]['cities'] as $city)
                                    <option value="{{ $city['id'] }}"
                                        >{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('city_id')
                            <span class="error">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="col-sm-6">
                        <label for="job_ar" class="form-label">Job</label>
                        <div class="position-relative">
                           <select
                           wire:model.live="title_id"
                           class="form-select"
                                >
                                @foreach ($jobs as $job)
                                <option value="{{ $job['id'] }}">{{ $job['job_ar'] }}</option>
                                @endforeach
                            </select>
                            </div>
                            @error('title_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        </div>



                    <div class="col-sm-6">
                        <label class="form-label" for="newPassword">New Password</label>
                        <div class="input-group input-group-merge has-validation">
                            <input class="form-control" wire:model.live="password" type="password"
                                id="newPassword" name="newPassword" placeholder="············">
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <button class="btn btn-label-secondary btn-prev waves-effect">
                          <i class="ti ti-arrow-left me-sm-1 me-0"></i>
                          <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        <button type="submit" class="btn btn-success btn-submit waves-effect waves-light">Submit</button>
                    </div>
            </div>
        </div>
        </form>

        @if ($errors->any())
        <div>
            <h3>Errors</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

      </div>
    </div>
  </div>

