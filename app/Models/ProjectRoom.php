<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRoom extends Model
{
    use HasFactory;

    /**
     * Mass assignable properties
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'seats',
        'description',
    ];

    /**
     * Hidden properties
     *
     * @var array
     */
    protected $hidden = [
        'code'
    ];

}
