<!-- Contacts -->
<div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end" id="app-chat-contacts">
    <div class="sidebar-header">
        <div class="d-flex align-items-center me-3 me-lg-0">
            <div class="flex-shrink-0 avatar avatar-online me-3" data-bs-toggle="sidebar"
                data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                <img class="user-avatar rounded-circle cursor-pointer"

 src="{{auth()->user()->getFirstMediaUrl('employs') }}"
  alt="{{auth()->user()->getFirstMediaUrl('employs') }}"
                     />
            </div>
            <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                <input wire:model.live="search" type="text" class="form-control chat-search-input" placeholder="Search..."
                    aria-label="Search..." aria-describedby="basic-addon-search31" />
            </div>
        </div>
        <i class="ti ti-x cursor-pointer d-lg-none d-block position-absolute mt-2 me-1 top-0 end-0" data-overlay
            data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
    </div>
    <hr class="container-m-nx m-0" />
    <div class="sidebar-body">
        <!-- Contacts -->
        <ul class="list-unstyled chat-contact-list mb-0" id="contact-list">
            <li class="chat-contact-list-item chat-contact-list-item-title">
                <h5 class="text-primary mb-0">Contacts</h5>
            </li>
            <li class="chat-contact-list-item contact-list-item-0 d-none">
                <h6 class="text-muted mb-0">No Contacts Found</h6>
            </li>




            @foreach ($employs as $employ)
            @if ($employ->id !== Auth::user()->id)
            <li class="chat-contact-list-item" id="{{ $employ->id }}" onclick="changeChatId('{{ $employ->id }}')">
                <a wire:click="choese({{ $employ }})" class="d-flex align-items-center">
                    <div class="avatar d-block flex-shrink-0">
                        <img
                          src="{{$employ->getFirstMediaUrl('employs') }}"
                          alt="{{$employ->getFirstMediaUrl('employs') }}"
                         />
                    </div>
                    <div class="chat-contact-info flex-grow-1 ms-2">
                        <h6 class="chat-contact-name text-truncate m-0">{{ $employ->name }}</h6>
                        <p class="chat-contact-status text-muted text-truncate mb-0">{{ $employ->title->job_ar }}</p>
                    </div>
                </a>
            </li>
            @endif
        @endforeach


        </ul>
    </div>
</div>
<!-- /Chat contacts -->
<script>
    function changeChatId(id) {
        document.getElementById(id).style.backgroundColor = '#7367f0';
        console.log(id);
    }
</script>
