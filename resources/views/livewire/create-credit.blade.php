<div class="row">
    <div class="col">
        <div class="form-group mt-3">
            <label class="mb-1" for="borrowerName">Borrower Name</label>
            <input wire:model="borrower" type="text" class="form-control" id="borrowerName">
            @error('borrower') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="form-group mt-5">
            <label class="mb-1" for="creditAmount">Amount</label>
            <input wire:model="amount" type="number" step="100" min="0" class="form-control" id="creditAmount">
            @error('amount') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <div class="form-group mt-5">
            <label class="mb-1" for="creditTerm">Term</label>
            <input wire:model="term" type="number" step="1" min="1" class="form-control" id="creditTerm">
            @error('term') <p class="text-danger">{{ $message }}</p> @enderror
        </div>
        <button type="button" wire:click="submit" class="btn btn-primary  mt-5">Create</button>
    </div>
</div>
