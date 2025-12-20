<?php

namespace Tests\Unit;

use App\Models\Investors;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class AverageAgeTest extends TestCase
{
    private const ROUTE = 'investors.getAverageAge';
    /**
     * A basic test example.
     */

    private int $averageAge;

    protected function setUp(): void
    {
        parent::setUp();
        $age = 10;
        $factoryAmount = 100;
        $this->averageAge = $age;
        Investors::factory($factoryAmount)->create(
            ['age' => $age]
        );
    }

    public function test_get_average_age(): void
    {
        $this->getJson(route(self::ROUTE))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'averageAge' => $this->averageAge
            ]);
    }
}
