<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuestBook extends Model
{
    protected $fillable = [
        'invitation_id',
        'invitation_guest_id',
        'guest_name',
        'attendance',
        'message',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
    public function invitationGuest()
    {
        return $this->belongsTo(InvitationGuest::class);
    }
}
