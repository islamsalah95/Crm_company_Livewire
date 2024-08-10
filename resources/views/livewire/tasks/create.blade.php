<div class="card-body">
    <x-alert/>
        <form id="formAccountSettings" wire:submit="save" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            @csrf
            <div class="row">
            <div class="mb-3 col-md-6 ">
                <label class="form-label" for="name">Task Name</label>
                <input class="form-control" type="text" id="name" wire:model.live="name">
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>


            <div class="mb-3 col-md-6">
                <label for="exampleFormControlSelect1" class="form-label">Project</label>
                <select  wire:model.live="project_id" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected="">Open this select menu</option>
                  @foreach($companyProjects as $companyProject)
                  <option value={{$companyProject->id}}>{{$companyProject->project_name}}</option>
                    @endforeach
                </select>
                @error('project_id') <span class="error">{{ $message }}</span> @enderror
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

            <div class="mb-3 col-md-6 ">
                <label for="defaultSelect" class="form-label">project type</label>
                <select wire:model.live="type" id="defaultSelect" class="form-select">
                    <option value="public">public</option>
                    <option value="private">private</option>
                </select>
                @error('type') <span class="error">{{ $message }}</span> @enderror
            </div>


            @if($showAssign==0)
            <div class="mb-12 col-md-12">
                <label for="exampleFormControlSelect1" class="form-label">assign Users</label>
                <select
                 wire:model.live="user_id"
                 class="form-select"
                 id="exampleFormControlSelect1"
                  aria-label="Default select example"
                  multiple
                  >
                    @foreach($companyUsers as $companyUser)
                    <option value={{$companyUser->id}}>{{ $companyUser->name }}</option>
                       @endforeach
                </select>
                @error('user_id') <span class="error">{{ $message }}</span> @enderror
              </div>
              @endif



             <div class="col-md-12 mb-12">
             <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
             <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>

             </div>

          </div>
    </form>
</div>
