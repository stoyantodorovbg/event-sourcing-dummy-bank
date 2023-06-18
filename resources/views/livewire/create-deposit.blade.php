<div wire:ignore.self
     class="modal fade"
     id="createDepositModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="createDepositModalLabel"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDepositModalLabel">Create Deposit</h5>
                <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mt-4">
                    <input wire:model="depositableSerial"
                           type="text"
                           class="form-control mb-1"
                           id="depositableSerial"
                           placeholder="Type in {{ strtolower($depositable) }} serial number"
                    >
                    <select wire:model="depositableSerial" class="form-select" id="depositableSerial">
                        <option selected value="">Or Select {{ $depositable }} Serial Number</option>
                        @foreach($this->depositableSerials as $serial)
                            <option wire:key="credit-{{ $serial }}" value="{{ $serial }}">{{ $serial }}</option>
                        @endforeach
                    </select>
                    @error('depositableSerial') <p class="text-danger">{{ $message }}</p> @enderror
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
