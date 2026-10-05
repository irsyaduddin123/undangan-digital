<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'path',
        'status',
    ];

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

}
