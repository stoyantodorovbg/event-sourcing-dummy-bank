<div>
    @include('livewire.alerts.alert', ['type' => 'success'])
    @include('livewire.alerts.alert', ['type' => 'warning'])
    <table id="credits-list" class="table table-striped my-5">
        <thead>
        <tr>
            <th>Customer Name</th>
            <th>Initial Amount</th>
            <th>Due Amount</th>
            <th>Deposit</th>
            <th>Term</th>
            <th>Remaining Installments</th>
            <th>Monthly Installment</th>
            <th>Serial Number</th>
            <th>Customer Serial Number</th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->credits as $credit)
            <tr wire:key="credits-list-{{ $loop->index }}">
                <td>{{ $credit->customer->name }}</td>
                <td>{{ $this->formatMoney->execute($credit->initial_amount) }} BGN</td>
                <td>{{ $this->formatMoney->execute($credit->amount) }} BGN</td>
                <td>{{ $this->formatMoney->execute($credit->deposit) }} BGN</td>
                <td>{{ $credit->term }} months</td>
                <td>{{ $this->formatMoney->execute($credit->initial_monthly_installment) }} BGN</td>
                <td>{{ $credit->remaining_installments }}</td>
                <td>{{ $credit->serial }}</td>
                <td>{{ $credit->customer->serial }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $this->credits->links() }}
    <livewire:create-credit/>
    <livewire:create-deposit :depositable="'Credit'"/>
</div>
