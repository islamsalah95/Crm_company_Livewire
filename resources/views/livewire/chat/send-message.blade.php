
<form  wire:submit.prevent="save" method="POST" class="form-send-message d-flex justify-content-between align-items-center">
    <input wire:model.live="message" class="form-control message-input border-0 me-3 shadow-none"
        placeholder="Type your message here" />
        @error('message') <span class="error">{{ $message }}</span> @enderror
        <div class="message-actions d-flex align-items-center">
        <i class="speech-to-text ti ti-microphone ti-sm cursor-pointer"></i>
        <label wire:model="file" for="attach-doc" class="form-label mb-0">
            <i class="ti ti-photo ti-sm cursor-pointer mx-3"></i>
            <input type="file" id="attach-doc" hidden />
        </label>
        <button type="submit" class="btn btn-primary d-flex send-msg-btn">
            <i class="ti ti-send me-md-1 me-0"></i>
            <span class="align-middle d-md-inline-block d-none">Send</span>
        </button>
    </div>
</form>
