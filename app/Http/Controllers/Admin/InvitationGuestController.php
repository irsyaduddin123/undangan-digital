<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\InvitationGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationGuestController extends Controller
{
    // Menampilkan daftar undangan
    public function index()
    {
        $invitations = Invitation::withCount('invitationGuests')
            ->latest()
            ->paginate(10);

        return view(
            'admin.invitation-guests.index',
            compact('invitations')
        );
    }

    // Menampilkan daftar tamu dari undangan yang dipilih
    public function guests(Invitation $invitation)
    {
        $guests = $invitation->invitationGuests()
            ->latest()
            ->paginate(10);

        return view(
            'admin.invitation-guests.guests',
            compact('invitation', 'guests')
        );
    }

    // Menambahkan tamu
    public function store(Request $request, Invitation $invitation)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
        ]);

        $guestName = $request->guest_name;

        $slug = Str::slug($guestName)
            . '-'
            . Str::lower(Str::random(8));

        $invitation->invitationGuests()->create([
            'guest_name' => $guestName,
            'slug' => $slug,
        ]);

        return redirect()
            ->route('admin.invitation-guests.guests', $invitation->id)
            ->with('success', 'Tamu berhasil ditambahkan.');
    }

    // Menghapus tamu
    public function destroy(
        Invitation $invitation,
        InvitationGuest $invitationGuest
    ) {
        // Pastikan tamu tersebut milik undangan yang dipilih
        abort_unless(
            $invitationGuest->invitation_id === $invitation->id,
            404
        );

        $invitationGuest->delete();

        return redirect()
            ->route('admin.invitation-guests.guests', $invitation->id)
            ->with('success', 'Tamu berhasil dihapus.');
    }
}
