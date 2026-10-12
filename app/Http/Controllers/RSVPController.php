<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\InvitationGuest;
use App\Models\GuestBook;
use Illuminate\Http\Request;

class RSVPController extends Controller
{
    public function store(Request $request, Invitation $invitation, InvitationGuest $invitationGuest)
    {
        abort_unless(
            $invitationGuest->invitation_id === $invitation->id,
            404
        );

        $request->validate([
            'attendance' => 'required|in:hadir,tidak_hadir,ragu',
            'message' => 'nullable|string|max:1000',
        ]);

        GuestBook::updateOrCreate(
            [
                'invitation_guest_id' => $invitationGuest->id,
            ],
            [
                'invitation_id' => $invitation->id,
                'guest_name' => $invitationGuest->guest_name,
                'attendance' => $request->attendance,
                'message' => $request->message,
            ]
        );

        return back()->with(
            'rsvp_success',
            'Konfirmasi kehadiran berhasil disimpan!'
        );
    }
}
