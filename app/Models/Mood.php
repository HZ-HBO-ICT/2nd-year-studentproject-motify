<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @Class   Mood
 *
 * @Package App\Models
 * @Author  Levi Deurloo <ldeurloo1@hz.nl>
 * @method  static findOrFail(int $id)
 * @method  static create(array $item)
 */
class Mood extends Model
{
    /**
     * Mass assignable properties
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'points',
        'tracking_date',
    ];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
