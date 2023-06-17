<?php

namespace Feature\Pages\Accounts;

use App\Actions\Interfaces\FormatMoneyInterface;
use Livewire\Livewire;
use Tests\TestCase;
use App\Projections\Account;

class AccountsIndexTest extends TestCase
{
    protected FormatMoneyInterface $formatMoney;

    protected function setUp(): void
    {
        parent::setUp();
        $this->formatMoney = resolve(FormatMoneyInterface::class);
    }

    /** @test */
    public function accounts_page_returns_a_successful_response(): void
    {
        $response = $this->get(route('accounts.index'))
            ->assertSee('Home')
            ->assertSee('Credits')
            ->assertSee('Accounts')
            ->assertSee('Create Account')
            ->assertSee('Create Deposit');

        $response->assertStatus(200);
    }

    /** @test */
    public function accounts_index_displays_all_accounts(): void
    {
        $accounts = Account::factory()->count(10)->create();
        foreach($accounts as $account) {
            Livewire::test('accounts-index')
                ->assertSee($this->formatMoney->execute($account->amount))
                ->assertSee($account->serial)
                ->assertSee($account->customer->name)
                ->assertSee($account->customer->serial);
        }
    }
}
