<div>
    <table id="availabilities-list" class="table table-striped my-5">
        <thead>
        <tr>
            <th>Type</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        @foreach($this->availabilities as $availability)
            <tr wire:key="availabilities-list-{{ $loop->index }}">
                <td>{{ $availability->name }}</td>
                <td>{{ $this->formatMoney->execute($availability->amount) }} BGN</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
