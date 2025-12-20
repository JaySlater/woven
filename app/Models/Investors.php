<?php

namespace App\Models;

use Database\Factories\InvestorsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\ApprovedApplication
 *
 * @property int $id
 * @property string $name
 * @property int $age
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Investors whereId($value)
 * @method static Builder|Investors whereName($value)
 * @method static Builder|Investors whereAge($value)
 * @method static Builder|Investors whereCreatedAt($value)
 * @method static Builder|Investors whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Investors extends Authenticatable
{
    /** @use HasFactory<InvestorsFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'age',
    ];
}
