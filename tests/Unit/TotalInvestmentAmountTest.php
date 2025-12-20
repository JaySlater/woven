<?php

namespace Tests\Unit;

use App\Models\InvestorEntries;
use App\Models\Investors;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TotalInvestmentAmountTest extends TestCase
{
    private const ROUTE = 'investors.getTotalInvestments';
    /**
     * A basic test example.
     */

    private int $totalInvestments;

    protected function setUp(): void
    {
        parent::setUp();
        Investors::factory()->create();

        $investmentAmount = 1000;
        $factoryAmount = 100;
        $this->totalInvestments = $factoryAmount;
        InvestorEntries::factory($factoryAmount)->create(
            ['investment_amount' => $investmentAmount]
        );
    }

    public function test_get_total_investment_amount(): void
    {
        $this->getJson(route(self::ROUTE))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'totalInvestments' => $this->totalInvestments
            ]);
    }
}
