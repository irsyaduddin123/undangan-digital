<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guest extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'image',
    ];

    /**
     * Gallery dimiliki oleh satu Invitation.
     */
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
