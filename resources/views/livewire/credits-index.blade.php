<div>
    <table id="credits-list" class="table table-striped my-5">
        <thead>
            <tr>
                <th>Borrower Name</th>
                <th>Due Amount</th>
                <th>Term</th>
                <th>Monthly Installment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->credits as $credit)
                <tr wire:key="credits-list-{{ $loop->index }}">
                    <td>{{ $credit->borrower->name }}</td>
                    <td>{{ number_format($credit->due_amount, 2, '.', ',') }} BGN</td>
                    <td>{{ $credit->term }} months</td>
                    <td>{{ number_format($credit->monthly_installment, 2, '.', ',') }} BGN</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>