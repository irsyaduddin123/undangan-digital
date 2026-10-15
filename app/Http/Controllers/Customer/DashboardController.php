<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\InvitationGuest;
use App\Models\GuestBook;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil undangan milik customer yang sedang login
        $invitations = Invitation::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        $invitationIds = $invitations->pluck('id');

        // Total tamu yang diundang
        $totalGuests = InvitationGuest::whereIn(
            'invitation_id',
            $invitationIds
        )->count();

        // Ambil RSVP dari tamu undangan milik customer
        $rsvp = GuestBook::whereIn('invitation_id', $invitationIds)
            ->whereNotNull('invitation_guest_id')
            ->selectRaw('invitation_guest_id, MAX(id) as latest_id')
            ->groupBy('invitation_guest_id')
            ->get()
            ->map(function ($item) {
                return GuestBook::find($item->latest_id);
            })
            ->filter();

        // Hitung status berdasarkan respons terakhir setiap tamu
        $hadir = $rsvp->where('attendance', 'hadir')->count();

        $tidakHadir = $rsvp->where('attendance', 'tidak_hadir')->count();

        $ragu = $rsvp->where('attendance', 'ragu')->count();

        $sudahKonfirmasi = $rsvp->count();

        // Tamu yang belum memberikan konfirmasi
        $belumKonfirmasi = max(
            0,
            $totalGuests - $sudahKonfirmasi
        );


        return view('customer.dashboard', compact(
            'invitations',
            'totalGuests',
            'hadir',
            'tidakHadir',
            'ragu',
            'belumKonfirmasi'
        ));
    }
    public function invitations()
    {
        $invitations = Invitation::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view('customer.invitations.index', compact('invitations'));
    }

    public function guest(){
        $guests = InvitationGuest::with(['invitation','GuestBook'])
        ->whereHas('invitation', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->latest()
        ->get();

        return view('customer.guests.index', compact('guests'));
            
    }
}
