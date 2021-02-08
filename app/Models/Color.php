<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @Class   Color
 *
 * @Package App\Models
 * @Author  Levi Deurloo <ldeurloo1@hz.nl>
 * @method static findOrFail(int $id)
 * @method static create(array $item)
 */
class Color extends Model
{
    /**
     * Mass assignable properties
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'code',
        'active',
    ];

}
