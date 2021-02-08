<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Preferences
 *
 * @method static find(int $int)
 * @method static create(array $array)
 * @method static delete(int $id)
 * @method static findOrFail(int $int)
 * @method static firstOrFail()
 * @property string   hue_username
 * @property string   hue_client_secret
 * @property string   hue_client_id
 * @property integer   hue_device_id;
 * @property string   hue_access_token
 * @property string   hue_refresh_token
 * @property DateTime hue_access_token_expires_at
 * @property integer   hue_access_token_expires_in
 * @property DateTime hue_refresh_token_expires_at
 * @property integer    hue_refresh_token_expires_in
 */
class Preferences extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hue_client_id',
        'hue_client_secret',
        'hue_device_id',
        'hue_username',
        'hue_access_token',
        'hue_access_token_expires_in',
        'hue_access_token_expires_at',
        'hue_refresh_token',
        'hue_refresh_token_expires_in',
        'hue_refresh_token_expires_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hue_access_token_expires_at' => 'datetime',
        'hue_refresh_token_expires_at' => 'datetime',
    ];

}
