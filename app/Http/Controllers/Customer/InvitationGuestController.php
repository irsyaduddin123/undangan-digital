<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\InvitationGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationGuestController extends Controller
{
    // Menampilkan daftar tamu customer
    public function index()
    {
        $guests = InvitationGuest::with([
            'invitation',
            'GuestBook',
        ])
            ->whereHas('invitation', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('customer.guests.index', compact('guests'));
    }

    // Menampilkan formulir tambah tamu
    public function create()
    {
        $invitations = Invitation::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view('customer.guests.create', compact('invitations'));
    }

    // Menyimpan tamu baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invitation_id' => ['required', 'integer'],
            'guest_name' => ['required', 'string', 'max:255'],
        ]);

        // Pastikan undangan milik customer yang login
        $invitation = Invitation::where(
            'user_id',
            auth()->id()
        )->findOrFail($validated['invitation_id']);

        // Buat slug unik untuk link personal
        do {
            $slug = Str::slug($validated['guest_name'])
                . '-' . Str::lower(Str::random(6));
        } while (
            InvitationGuest::where('slug', $slug)->exists()
        );

        InvitationGuest::create([
            'invitation_id' => $invitation->id,
            'guest_name' => $validated['guest_name'],
            'slug' => $slug,
        ]);

        return redirect()
            ->route('customer.guests')
            ->with('success', 'Tamu berhasil ditambahkan.');
    }
}
