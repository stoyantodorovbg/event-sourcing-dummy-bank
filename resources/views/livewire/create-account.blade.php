<div wire:ignore.self
     class="modal fade"
     id="createAccountModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="createAccountModalLabel"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAccountModalLabel">Create Account</h5>
                <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mt-4">
                    <input wire:model="customerName" type="text" class="form-control" id="customerName" placeholder="Customer Name">
                    @error('customerName') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group mt-4">
                    <input wire:model="customerSerial"
                           type="text"
                           class="form-control mb-1"
                           id="accountSerial"
                           placeholder="Type in customer serial number"
                    >
                    <select wire:model="customerSerial" class="form-select" id="accountSerial">
                        <option selected value="">Or Select Customer Serial Number</option>
                        @foreach($this->customersSerials as $serial)
                            <option wire:key="customer-{{ $serial }}" value="{{ $serial }}">{{ $serial }}</option>
                        @endforeach
                    </select>
                    @error('customerSerial') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group mt-4">
                    <input wire:model="amount"
                           type="number"
                           step="100"
                           min="0"
                           class="form-control"
                           id="accountAmount"
                           placeholder="Amount (BGN)"
                    >
                    @error('amount') <p class="text-danger">{{ $message }}</p> @enderror
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
