<?php

namespace Tests\Feature\Pages\Home;

use App\Projections\Borrower;
use App\Projections\Credit;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateCreditTest extends TestCase
{
    use WithFaker;

    protected array $creditData = [
        'borrower' => 'Borrower Names',
        'amount' => 333.33,
        'term' => 12,
    ];

    /** @test */
    public function create_credit_form_fields_and_buttons(): void
    {
        Livewire::test('create-credit')
            ->assertSee('Borrower Name')
            ->assertSee('Amount (BGN)')
            ->assertSee('Term')
            ->assertSee('Create')
            ->assertSee('Close')
            ->assertSee('borrower')
            ->assertSee('amount')
            ->assertSee('term');
    }

    /** @test */
    public function create_credit_sets_the_entered_inputs(): void
    {
        Livewire::test('create-credit', $this->creditData)
            ->assertSet('borrower', $this->creditData['borrower'])
            ->assertSet('amount', $this->creditData['amount'])
            ->assertSet('term', $this->creditData['term']);
    }

    /** @test */
    public function create_a_credit(): void
    {
        Livewire::test('create-credit', $this->creditData)->call('submit');
        $this->assertDataBaseHas('credits', [
            'amount' => $this->creditData['amount'],
            'term' => $this->creditData['term'],
        ]);
        $this->assertDataBaseHas('borrowers', [
            'name' => $this->creditData['borrower'],
        ]);
    }

    /** @test */
    public function the_created_credit_is_displayed_on_credits_index(): void
    {
        Livewire::test('create-credit', $this->creditData)->call('submit');
        Livewire::test('credits-index')
            ->assertSee($this->creditData['borrower'])
            ->assertSee($this->creditData['amount'])
            ->assertSee('term', $this->creditData['term']);
    }

    /** @test */
    public function when_enter_name_of_existing_borrower_the_credit_is_assigned_to_him(): void
    {
        $borrower = Borrower::factory()->create();
        $creditData = $this->creditData;
        $creditData['borrower'] = $borrower->name;
        Livewire::test('create-credit', $creditData)->call('submit');
        $this->assertDatabaseCount('borrowers', 1);
        $this->assertDatabaseCount('credits', 1);
        $this->assertEquals(Borrower::first()->uuid, Credit::first()->borrower_uuid);
    }

    /** @test */
    public function when_create_a_credit_with_new_borrower_name_a_borrower_is_created(): void
    {
        for($i = 0; $i < 10; $i++) {
            Borrower::factory()->create(['name' => $this->faker->unique()->name]);
        }
        $creditData = $this->creditData;
        $creditData['borrower'] = $this->faker->unique()->name;
        Livewire::test('create-credit', $creditData)->call('submit');
        $this->assertDatabaseCount('borrowers', 11);
    }

    /** @test */
    public function borrower_can_not_have_credits_with_total_amount_more_then_80000(): void
    {
        $borrower = Borrower::factory()->create();
        Credit::factory()->create([
            'borrower_uuid' => $borrower->uuid,
            'amount' => 79998,
        ]);
        $this->assertDatabaseCount('credits', 1);
        Livewire::test('create-credit', [
            'borrower' => $borrower->name,
            'amount' => 1,
            'term' => 1,
        ])->call('submit');
        $this->assertDatabaseCount('credits', 2);
        Livewire::test('create-credit', [
            'borrower' => $borrower->name,
            'amount' => 2,
            'term' => 1,
        ])->call('submit');
        $this->assertDatabaseCount('credits', 2);

        Livewire::test('create-credit', [
            'borrower' => $this->faker->name,
            'amount' => 2,
            'term' => 1,
        ])->call('submit');
        $this->assertDatabaseCount('credits', 3);
    }

    /** @test */
    public function when_part_of_due_amount_has_been_paid__new_credits_up_to_80000_can_be_created(): void
    {
        $borrower = Borrower::factory()->create();
        $credit = Credit::factory()->create([
            'borrower_uuid' => $borrower->uuid,
            'amount' => 79999,
        ]);
        $this->assertDatabaseCount('credits', 1);
        Livewire::test('create-credit', [
            'borrower' => $borrower->name,
            'amount' => 2,
            'term' => 1,
        ])->call('submit');
        $this->assertDatabaseCount('credits', 1);
        Livewire::test('create-payment', [
            'creditCode' => $credit->code,
            'deposit' => 100,
        ])->call('submit');
        Livewire::test('create-credit', [
            'borrower' => $borrower->name,
            'amount' => 100,
            'term' => 1,
        ])->call('submit');
        $this->assertDatabaseCount('credits', 2);
    }
}
