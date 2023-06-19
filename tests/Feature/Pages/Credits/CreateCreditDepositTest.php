<?php

namespace Feature\Pages\Credits;

use App\Actions\Interfaces\FormatMoneyInterface;
use App\Http\Livewire\CreateDeposit;
use App\Projections\Credit;
use Livewire\Livewire;
use Tests\TestCase;

class CreateCreditDepositTest extends TestCase
{
    protected FormatMoneyInterface $formatMoney;

    protected function setUp(): void
    {
        parent::setUp();
        $this->formatMoney = resolve(FormatMoneyInterface::class);
    }

    /** @test */
    public function create_deposit_form_fields_and_buttons(): void
    {
        $credits = Credit::factory()->count(10)->create();
        $livewire = Livewire::test(CreateDeposit::class, ['depositable' => 'Credit']);

        $livewire
            ->assertSee('Type in credit serial')
            ->assertSee('Or Select Credit Serial Number')
            ->assertSee('Amount (BGN)')
            ->assertSee('Create')
            ->assertSee('Close')
            ->assertSee('depositableSerial')
            ->assertSee('deposit');

        foreach($credits as $credit) {
            $livewire->assertSee($credit->serial);
        }
    }

    /** @test */
    public function create_deposit_sets_the_entered_inputs(): void
    {
        $credit = Credit::factory()->create();
        Livewire::test(CreateDeposit::class, [
            'depositable' => 'Credit',
            'depositableSerial' => $credit->serial,
            'deposit' => 100,
        ])->assertSet('depositableSerial', $credit->serial)
            ->assertSet('deposit', 100);
    }

    /** @test */
    public function create_a_deposit(): void
    {
        $credit = Credit::factory()->create(['amount' => 3345.33]);
        $deposit = 222.22;
        Livewire::test(CreateDeposit::class, [
            'depositable' => 'Credit',
            'depositableSerial' => $credit->serial,
            'deposit' => $deposit,
        ])->call('submit');

        $this->assertDataBaseHas('credits', [
            'serial' => $credit->serial,
            'amount' => $credit->amount - $deposit,
            'deposit' => $deposit,
        ]);
    }

    /** @test */
    public function the_created_deposit_is_displayed_on_credits_index(): void
    {
        $amount = 23546.33;
        $credit = Credit::factory()->create(compact('amount'));
        $deposit = 2234.44;
        Livewire::test(CreateDeposit::class, [
            'depositable' => 'Credit',
            'depositableSerial' => $credit->serial,
            'deposit' => $deposit,
        ])->call('submit');
        Livewire::test('credits-index')->assertSee($this->formatMoney->execute($amount - $deposit));
    }

    /** @test */
    public function when_the_deposit_exeeds_allowable_amount_only_the_allowable_amount_is_deposited()
    {
        $credit = Credit::factory()->create([
            'amount' => 10000,
        ]);
        Livewire::test(CreateDeposit::class, [
            'depositable' => 'Credit',
            'depositableSerial' => $credit->serial,
            'deposit' => 15000,
        ])->call('submit');
        $this->assertDatabaseHas('credits', [
            'serial' => $credit->serial,
            'amount' => 0,
            'deposit' => 10000,
        ]);
    }
}
