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

        // Rekap RSVP
        $hadir = GuestBook::whereIn(
            'invitation_id',
            $invitationIds
        )->where('attendance', 'hadir')->count();

        $tidakHadir = GuestBook::whereIn(
            'invitation_id',
            $invitationIds
        )->where('attendance', 'tidak_hadir')->count();

        $ragu = GuestBook::whereIn(
            'invitation_id',
            $invitationIds
        )->where('attendance', 'ragu')->count();

        // Tamu yang belum memberikan konfirmasi
        $sudahKonfirmasi = GuestBook::whereIn(
            'invitation_id',
            $invitationIds
        )->whereNotNull('invitation_guest_id')
         ->distinct('invitation_guest_id')
         ->count('invitation_guest_id');

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
