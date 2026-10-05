<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'slug',
        'bride_name',
        'groom_name',
        'wedding_date',
        'akad_date',
        'reception_date',
        'location_name',
        'address',
        'google_maps',
        'cover_image',
        'music',
        'status',
        'expired_at',
    ];

    protected $casts = [
        'wedding_date' => 'date',
        'akad_date' => 'datetime',
        'reception_date' => 'datetime',
        'expired_at' => 'datetime',
    ];

    /**
     * Invitation dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Invitation menggunakan satu Template.
     */
    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    /**
     * Invitation mempunyai banyak Gallery.
     */
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    /**
     * Invitation mempunyai banyak Guest Book.
     */
    public function guestBooks()
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * Invitation mempunyai banyak Order.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
