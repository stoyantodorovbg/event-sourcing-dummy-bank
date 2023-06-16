<?php

namespace Tests\Feature\Pages\Credits;

use App\Actions\Interfaces\FormatMoneyInterface;
use App\Projections\Credit;
use Livewire\Livewire;
use Tests\TestCase;

class CreditsIndexTest extends TestCase
{
    protected FormatMoneyInterface $formatMoney;

    protected function setUp(): void
    {
        parent::setUp();
        $this->formatMoney = resolve(FormatMoneyInterface::class);
    }

    /** @test */
    public function credits_page_returns_a_successful_response(): void
    {
        $response = $this->get(route('credits.index'))
            ->assertSee('Home')
            ->assertSee('Credits')
            ->assertSee('Create Credit')
            ->assertSee('Create Payment');

        $response->assertStatus(200);
    }

    /** @test */
    public function credits_index_displays_all_credits(): void
    {
        $credits = Credit::factory()->count(10)->create();
        foreach($credits as $credit) {
            Livewire::test('credits-index')
                ->assertSee($this->formatMoney->execute($credit->due_amount))
                ->assertSee($this->formatMoney->execute($credit->monthly_installment))
                ->assertSee($credit->term)
                ->assertSee($credit->code)
                ->assertSee($credit->customer->name);
        }
    }
}
