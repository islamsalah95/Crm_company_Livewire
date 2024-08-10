<div class="card-body">
    <x-alert/>
        <form id="formAccountSettings" wire:submit="save" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            @csrf
            <div class="row">
            <div class="mb-3 col-md-6 ">
                <label class="form-label" for="project_name">Project Name</label>
                <input class="form-control" type="text" id="project_name" wire:model.live="project_name">
                @error('project_name') <span class="error">{{ $message }}</span> @enderror
            </div>


            <div class="mb-3 col-md-6 ">
                <label for="defaultSelect" class="form-label">project type</label>
                <select wire:model.live="project_type" id="defaultSelect" class="form-select">
                    <option value="public">public</option>
                    <option value="none">none</option>
                </select>
                @error('project_type') <span class="error">{{ $message }}</span> @enderror
            </div>


            <div class="mb-3 col-md-6 ">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="block mt-1 w-full form-control" id="start_date" wire:model.live="start_date">
                @error('start_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="block mt-1 w-full form-control" id="end_date" wire:model.live="end_date">
                @error('end_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            @if($showAssign==0)
            <div class="mb-3 col-md-6">
                <label for="exampleFormControlSelect1" class="form-label">Example select</label>
                <select 
                 wire:model.live="select" 
                 class="form-select" 
                 id="exampleFormControlSelect1"
                  aria-label="Default select example"
                  multiple
                  >
                    @foreach($companyUsers as $companyUser)
                    <option value={{$companyUser->id}}>{{ $companyUser->name }}</option>
                       @endforeach
                </select>
              </div>
            {{--  <div class="col-md-12 mb-4">
                <label for="selectpickerLiveSearch" class="form-label">assign Users</label>
                <div class="dropdown bootstrap-select w-100 dropup">
                    <select 
                    id="selectpickerLiveSearch"
                     class="selectpicker w-100"
                      data-style="btn-default"
                      data-live-search="true"
                       tabindex="null"
                       multiple
                       wire:model.live="select"
                       >
                @foreach($companyUsers as $companyUser)
             <option value={{$companyUser->id}} data-tokens="{{$companyUser->id}}">{{ $companyUser->name }}</option>
                @endforeach
                    </select>
                </div>
            </div>  --}}
            @endif

             <div class="col-md-12 mb-12">
             <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
             <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
             
             </div>
    
          </div>
    </form>
</div>
