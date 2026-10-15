<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\InvitationGuest;
use Illuminate\Http\Request;

class RSVPController extends Controller
{
    public function index()
    {
        $invitationIds = Invitation::where(
            'user_id',
            auth()->id()
        )->pluck('id');

        $guests = InvitationGuest::with('GuestBook')
            ->whereIn('invitation_id', $invitationIds)
            ->latest()
            ->get();

        return view('customer.rsvp.index', compact('guests'));
    }
}

