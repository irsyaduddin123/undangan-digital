<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvitationGuest extends Model
{
    //
    protected $fillable = [
        'invitation_id',
        'guest_name',
        'slug',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    public function GuestBook()
    {
        return $this->hasMany(GuestBook::class,'invitation_guest_id');
    }
//     public function guestBooks()
// {
//     return $this->hasMany(
//         GuestBook::class,
//         'invitation_guest_id'
//     );
// }
}
