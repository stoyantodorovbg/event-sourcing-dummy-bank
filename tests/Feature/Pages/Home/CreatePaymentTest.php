<?php

namespace Tests\Feature\Pages\Home;

use App\Actions\Interfaces\FormatMoneyInterface;
use App\Projections\Borrower;
use App\Projections\Credit;
use Livewire\Livewire;
use Tests\TestCase;

class CreatePaymentTest extends TestCase
{
    protected FormatMoneyInterface $formatMoney;

    protected function setUp(): void
    {
        parent::setUp();
        $this->formatMoney = resolve(FormatMoneyInterface::class);
    }

    /** @test */
    public function create_payment_form_fields_and_buttons(): void
    {
        $credits = Credit::factory()->count(10)->create();
        $livewire = Livewire::test('create-payment');

        $livewire
            ->assertSee('Type in credit code')
            ->assertSee('Or Select Credit Code')
            ->assertSee('Amount (BGN)')
            ->assertSee('Create')
            ->assertSee('Close')
            ->assertSee('creditCode')
            ->assertSee('deposit');

        foreach($credits as $credit) {
            $livewire->assertSee($credit->code);
        }
    }

    /** @test */
    public function create_payment_sets_the_entered_inputs(): void
    {
        $credit = Credit::factory()->create();
        Livewire::test('create-payment', [
            'creditCode' => $credit->code,
            'deposit' => 100,
        ])
            ->assertSet('creditCode', $credit->code)
            ->assertSet('deposit', 100);
    }

    /** @test */
    public function create_a_payment(): void
    {
        $credit = Credit::factory()->create(['amount' => 3345.33]);
        $deposit = 222.22;
        Livewire::test('create-payment', [
            'creditCode' => $credit->code,
            'deposit' => $deposit,
        ])->call('submit');

        $this->assertDataBaseHas('credits', [
            'code' => $credit->code,
            'amount' => $credit->amount,
            'deposit' => $deposit,
        ]);
    }

    /** @test */
    public function the_created_payment_is_displayed_on_credits_index(): void
    {
        $amount = 23546.33;
        $credit = Credit::factory()->create(compact('amount'));
        $deposit = 2234.44;
        Livewire::test('create-payment', [
            'creditCode' => $credit->code,
            'deposit' => $deposit,
        ])->call('submit');
        Livewire::test('credits-index')->assertSee($this->formatMoney->execute($amount - $deposit));
    }

    /** @test */
    public function when_the_payment_exeeds_due_amount_only_the_due_amount_is_deposited()
    {
        $credit = Credit::factory()->create([
            'amount' => 10000,
        ]);
        Livewire::test('create-payment', [
            'creditCode' => $credit->code,
            'deposit' => 15000,
        ])->call('submit');
        $this->assertDatabaseHas('credits', [
            'code' => $credit->code,
            'amount' => 10000,
            'deposit' => 10000,
        ]);
    }
}
