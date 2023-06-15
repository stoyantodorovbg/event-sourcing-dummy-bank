<div>
    @include('livewire.alerts.alert', ['type' => 'success'])
    @include('livewire.alerts.alert', ['type' => 'warning'])
    <table id="credits-list" class="table table-striped my-5">
        <thead>
        <tr>
            <th>Borrower Name</th>
            <th>Due Amount</th>
            <th>Term</th>
            <th>Monthly Installment</th>
            <th>Code</th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->credits as $credit)
            <tr wire:key="credits-list-{{ $loop->index }}">
                <td>{{ $credit->borrower->name }}</td>
                <td>{{ $this->formatMoney->execute($credit->due_amount) }} BGN</td>
                <td>{{ $credit->term }} months</td>
                <td>{{ $this->formatMoney->execute($credit->monthly_installment) }} BGN</td>
                <td>{{ $credit->code }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <livewire:create-credit/>
    <livewire:create-payment/>
</div>
