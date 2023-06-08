<div class="row">
    <div class="col">
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
        <button type="button" wire:click="submit" class="btn btn-primary  mt-5">Create</button>
    </div>
</div>
