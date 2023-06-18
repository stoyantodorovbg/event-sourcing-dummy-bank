<?php

namespace Feature\Pages\Accounts;

use App\Http\Livewire\CreateDeposit;
use App\Projections\Account;
use Livewire\Livewire;
use Tests\TestCase;

class CreateAccountDepositTest extends TestCase
{
    /** @test */
    public function create_deposit_form_fields_and_buttons(): void
    {
        $accounts = Account::factory()->count(10)->create();
        $livewire = Livewire::test(CreateDeposit::class, ['depositable' => 'Account']);

        $livewire
            ->assertSee('Type in account serial')
            ->assertSee('Or Select Account Serial Number')
            ->assertSee('Amount (BGN)')
            ->assertSee('Create')
            ->assertSee('Close')
            ->assertSee('depositableSerial')
            ->assertSee('deposit');

        foreach($accounts as $account) {
            $livewire->assertSee($account->serial);
        }
    }

    /** @test */
    public function create_deposit_sets_the_entered_inputs(): void
    {
        $account = Account::factory()->create();
        Livewire::test(CreateDeposit::class, [
            'depositable' => 'Account',
            'depositableSerial' => $account->serial,
            'deposit' => 100,
        ])->assertSet('depositableSerial', $account->serial)
            ->assertSet('deposit', 100);
    }

    /** @test */
    public function create_a_deposit(): void
    {
        $account = Account::factory()->create(['amount' => 3345.33]);
        $deposit = 222.22;
        Livewire::test(CreateDeposit::class, [
            'depositable' => 'Account',
            'depositableSerial' => $account->serial,
            'deposit' => $deposit,
        ])->call('submit');

        $this->assertDataBaseHas('accounts', [
            'serial' => $account->serial,
            'amount' => 222.22 + 3345.33,
        ]);
    }
}
