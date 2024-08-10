<div class="col-12 mb-4">
    <x-alert />
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
        <div class="step active" data-target="#social-links">
          <button type="button" class="step-trigger" aria-selected="true">
            <span class="bs-stepper-circle">3</span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Company</span>
              <span class="bs-stepper-subtitle">Add Company</span>
            </span>
          </button>
        </div>
      </div>
      <div class="bs-stepper-content">
        <form wire:submit.prevent="submitForm" method="POST" onsubmit="return false">
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
          <div id="social-links" class="content active dstepper-block">
            <div class="content-header mb-3">
              <h6 class="mb-0">Company</h6>
              <small>Edit Your Company.</small>
            </div>
            <div class="row g-3">
                
                @if($logo)
                <div class="col-sm-12">
                    <img src="{{ asset($logo) }}" class="avatar-preview" alt="Avatar Preview">
                </div>
                @endif

                <div class="col-sm-6">
                    <label for="logo" class="form-label">logo</label>
                    <input class="form-control" wire:model.live="logo" type="file" id="logo">
                    @error('logo') <span class="error">{{ $message }}</span> @enderror
                </div>
                

                
                <div class="col-sm-6">
                    <label class="form-label" for="company_name">Company Name</label>
                    <input type="text" id="company_name" class="form-control" wire:model.live="company_name">
                    @error('company_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="col-sm-6">
                    <label class="form-label" for="username">Company Website</label>
                    <input type="text" id="company_website" class="form-control"
                    wire:model.live="company_website">
                        @error('company_website') <span class="error">{{ $message }}</span> @enderror

                </div>


                <div class="col-sm-6">
                    <label class="form-label" for="company_address">Company Address</label>
                    <input type="text" id="company_address" class="form-control"
                    wire:model.live="company_address"
                    >
                        @error('company_address') <span class="error">{{ $message }}</span> @enderror

                </div>

                <div class="col-sm-6">
                    <label class="form-label" for="company_email">Company Email</label>
                    <input 
                    type="email" 
                    id="company_email"
                    class="form-control" 
                    wire:model.live="company_email"
                        >
                        @error('company_email') <span class="error">{{ $message }}</span> @enderror

                </div>


                <div class="col-sm-6">
                    <label class="form-label" for="telephone1">Company telephone</label>
                    <input type="number" id="telephone1" class="form-control" wire:model.live="telephone1">
                    @error('telephone1') <span class="error">{{ $message }}</span> @enderror

                </div>

                <div class="col-sm-6">
                    <label class="form-label" for="zip">zip</label>
                    <input type="number" id="zip" class="form-control" wire:model.live="zip">
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
                       wire:model.live="state"
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
                       <select wire:model.live="city"
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
                    <button type="submit" class="btn btn-success btn-submit waves-effect waves-light">Submit</button>
                </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>

