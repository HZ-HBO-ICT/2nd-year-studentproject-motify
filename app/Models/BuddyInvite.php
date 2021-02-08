<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuddyInvite extends Model
{
    use HasFactory;

    /**
     * Properties which are guarded
     * @var array
     */
    protected $guarded = [];

    /**
     * Gets the user which got invited to help.
     * @return BelongsTo
     */
    public function requestedUser()
    {
        return $this->belongsTo(User::class, 'requested_user_id');
    }

    /**
     * Gets the user who requested the user
     * @return BelongsTo
     */
    public function requestedByUser()
    {
        return $this->belongsTo(User::class, 'requested_by_user_id');
    }


}
