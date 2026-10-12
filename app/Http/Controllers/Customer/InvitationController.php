<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\InvitationGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationGuestController extends Controller
{
    public function index(Invitation $invitation)
    {
        abort_unless(
            $invitation->user_id === auth()->id(),
            403
        );

        $guests = $invitation->invitationGuests()
            ->latest()
            ->paginate(10);

        return view(
            'customer.invitation-guests.index',
            compact('invitation', 'guests')
        );
    }

    public function store(Request $request, Invitation $invitation)
    {
        abort_unless(
            $invitation->user_id === auth()->id(),
            403
        );

        $validated = $request->validate([
            'guest_name' => ['required', 'string', 'max:255'],
        ]);

        $baseSlug = Str::slug($validated['guest_name']);

        if (empty($baseSlug)) {
            $baseSlug = 'tamu';
        }

        do {
            $slug = $baseSlug . '-' . Str::lower(Str::random(6));
        } while (InvitationGuest::where('slug', $slug)->exists());

        $guest = $invitation->invitationGuests()->create([
            'guest_name' => $validated['guest_name'],
            'slug' => $slug,
        ]);

        return redirect()
            ->route('customer.invitation-guests.index', $invitation->id)
            ->with('success', 'Tamu berhasil ditambahkan.');
    }

    public function destroy(
        Invitation $invitation,
        InvitationGuest $invitationGuest
    ) {
        abort_unless(
            $invitation->user_id === auth()->id(),
            403
        );

        abort_unless(
            $invitationGuest->invitation_id === $invitation->id,
            404
        );

        $invitationGuest->delete();

        return redirect()
            ->route('customer.invitation-guests.index', $invitation->id)
            ->with('success', 'Tamu berhasil dihapus.');
    }
}