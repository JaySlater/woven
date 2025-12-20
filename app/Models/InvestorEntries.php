<?php

namespace App\Models;

use Database\Factories\InvestorEntriesFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\InvestorEntries
 *
 * @property int $id
 * @property Investors $investor_id
 * @property float $investment_amount
 * @property Carbon $investment_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|InvestorEntries whereId($value)
 * @method static Builder|InvestorEntries whereInvestorId($value)
 * @method static Builder|InvestorEntries whereInvestmentAmount($value)
 * @method static Builder|InvestorEntries whereInvestmentDate($value)
 * @method static Builder|InvestorEntries whereCreatedAt($value)
 * @method static Builder|InvestorEntries whereUpdatedAt($value)
 * @mixin Eloquent
 */
class InvestorEntries extends Authenticatable
{
    /** @use HasFactory<InvestorEntriesFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'investor_id',
        'investment_amount',
        'investment_date',
    ];
}
