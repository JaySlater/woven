<?php

namespace Tests\Unit;

use App\Models\InvestorEntries;
use App\Models\Investors;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AverageInvestmentAmountTest extends TestCase
{
    private const ROUTE = 'investors.getAverageInvestmentAmount';
    /**
     * A basic test example.
     */

    private int $averageInvestmentAmount;

    protected function setUp(): void
    {
        parent::setUp();
        Investors::factory()->create();

        $investmentAmount = 1000;
        $factoryAmount = 100;
        $this->averageInvestmentAmount = $investmentAmount;
        InvestorEntries::factory($factoryAmount)->create(
            ['investment_amount' => $investmentAmount]
        );
    }

    public function test_get_average_investment_amount(): void
    {
        $this->getJson(route(self::ROUTE))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'averageInvestmentAmount' => $this->averageInvestmentAmount
            ]);
    }
}
