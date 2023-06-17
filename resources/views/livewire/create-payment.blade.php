<div wire:ignore.self
     class="modal fade"
     id="createPaymentModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="createPaymentModalLabel"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPaymentModalLabel">Create Payment</h5>
                <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mt-4">
                    <input wire:model="creditSerial"
                           type="text"
                           class="form-control mb-1"
                           id="creditSerial"
                           placeholder="Type in credit serial number"
                    >
                    <select wire:model="creditSerial" class="form-select" id="creditSerial">
                        <option selected value="">Or Select Credit Serial Number</option>
                        @foreach($this->creditsSerials as $serial)
                            <option wire:key="credit-{{ $serial }}" value="{{ $serial }}">{{ $serial }}</option>
                        @endforeach
                    </select>
                    @error('creditSerial') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group mt-4">
                    <input wire:model="deposit"
                           type="number"
                           step="100"
                           min="0"
                           class="form-control"
                           id="creditAmount"
                           placeholder="Amount (BGN)"
                    >
                    @error('deposit') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click="submit" class="btn btn-primary">
                    Create
                </button>
            </div>
        </div>
    </div>
</div>
