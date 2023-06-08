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
                    <div class="form-group mt-3">
                        <label class="mb-1" for="creditCode">Credit Code</label>
                        <input wire:model="creditCode" type="text" class="form-control mb-1" id="creditCode" placeholder="Type in credit code">
                        <select wire:model="creditCode" class="form-select" id="creditCode">
                            <option selected value="">Please Select</option>
                            @foreach($this->credits as $code)
                                <option wire:key="{{ $code }}" value="{{ $code }}">{{ $code }}</option>
                            @endforeach
                        </select>
                        @error('creditCode') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group mt-5">
                        <label class="mb-1" for="creditAmount">Amount</label>
                        <input wire:model="deposit" type="number" step="100" min="0" class="form-control" id="creditAmount">
                        @error('deposit') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click="submit" class="btn btn-primary" data-bs-dismiss="modal">
                    Create
                </button>
            </div>
        </div>
    </div>
</div>
