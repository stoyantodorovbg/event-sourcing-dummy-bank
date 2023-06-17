<div>
    @include('livewire.alerts.alert', ['type' => 'success'])
    @include('livewire.alerts.alert', ['type' => 'warning'])
    <table id="accounts-list" class="table table-striped my-5">
        <thead>
        <tr>
            <th>Customer Name</th>
            <th>Amount</th>
            <th>Serial Number</th>
            <th>Customer Serial Number</th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->accounts as $account)
            <tr wire:key="accounts-list-{{ $loop->index }}">
                <td>{{ $account->customer->name }}</td>
                <td>{{ $this->formatMoney->execute($account->amount) }} BGN</td>
                <td>{{ $account->serial }}</td>
                <td>{{ $account->customer->serial }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $this->accounts->links() }}
    <livewire:create-account/>
    <livewire:create-deposit :depositable="'Account'"/>
</div>
