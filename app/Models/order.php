<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
        use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'invitation_id',
        'invoice_number',
        'total',
        'payment_status',
        'paid_at',
    ];

    protected $casts = [
        'total' => 'integer',
        'paid_at' => 'datetime',
    ];

    /**
     * Order dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order menggunakan satu Package.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Order berkaitan dengan satu Invitation.
     */
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
