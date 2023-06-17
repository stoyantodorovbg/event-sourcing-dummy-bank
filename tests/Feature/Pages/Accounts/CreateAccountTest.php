<?php

namespace Feature\Pages\Accounts;

use App\Projections\Account;
use App\Projections\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    use WithFaker;

    protected array $accountData = [
        'customerName' => 'Customer Names',
        'amount' => 333.33,
    ];

    /** @test */
    public function create_account_form_fields_and_buttons(): void
    {
        Livewire::test('create-account')
            ->assertSee('Customer Name')
            ->assertSee('Amount (BGN)')
            ->assertSee('Create')
            ->assertSee('Close')
            ->assertSee('customer')
            ->assertSee('amount');
    }

    /** @test */
    public function create_account_sets_the_entered_inputs(): void
    {
        Livewire::test('create-account', $this->accountData)
            ->assertSet('customerName', $this->accountData['customerName'])
            ->assertSet('amount', $this->accountData['amount']);
    }

    /** @test */
    public function create_a_account(): void
    {
        Livewire::test('create-account', $this->accountData)->call('submit');
        $this->assertDataBaseHas('accounts', [
            'amount' => $this->accountData['amount'],
        ]);
        $this->assertDataBaseHas('customers', [
            'name' => $this->accountData['customerName'],
        ]);
    }

    /** @test */
    public function the_created_account_is_displayed_on_accounts_index(): void
    {
        Livewire::test('create-account', $this->accountData)->call('submit');
        Livewire::test('accounts-index')
            ->assertSee($this->accountData['customerName'])
            ->assertSee($this->accountData['amount']);
    }

    /** @test */
    public function when_enter_serial_of_existing_customer_the_account_is_assigned_to_him(): void
    {
        $customer = Customer::factory()->create();
        $accountData = $this->accountData;
        $accountData['customerSerial'] = $customer->serial;
        Livewire::test('create-account', $accountData)->call('submit');
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('accounts', 1);
        $this->assertEquals(Customer::first()->serial, Account::first()->customer_serial);
    }

    /** @test */
    public function when_enter_customer_name_and_customer_serial_is_missing_a_new_customer_is_created(): void
    {
        $accountData = $this->accountData;
        Livewire::test('create-account', $accountData)->call('submit');
        $this->assertDatabaseCount('customers', 1);
        $this->assertDatabaseCount('accounts', 1);
        $this->assertEquals(Customer::first()->serial, Account::first()->customer_serial);
    }

    /** @test */
    public function when_create_a_account_with_new_customer_name_a_customer_is_created(): void
    {
        for($i = 0; $i < 10; $i++) {
            Customer::factory()->create(['name' => $this->faker->unique()->name]);
        }
        $accountData = $this->accountData;
        $accountData['customerName'] = $this->faker->unique()->name;
        Livewire::test('create-account', $accountData)->call('submit');
        $this->assertDatabaseCount('customers', 11);
    }
}
