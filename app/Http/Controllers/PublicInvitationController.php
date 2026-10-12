<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\InvitationGuest;

class PublicInvitationController extends Controller
{
    public function show(Invitation $invitation)
    {
        $invitation->load([
            'template',
            'galleries',
        ]);

        if ($invitation->status !== 'active') {
            abort(404);
        }

        if (
            $invitation->expired_at &&
            now()->greaterThan($invitation->expired_at)
        ) {
            abort(404);
        }

        if (!$invitation->template) {
            abort(404, 'Template undangan tidak ditemukan.');
        }

        $templatePath = $invitation->template->path;

        if (!view()->exists($templatePath)) {
            abort(404, 'File template tidak ditemukan.');
        }

        return view($templatePath, compact('invitation'));
    }

    public function showGuest(
        Invitation $invitation,
        InvitationGuest $invitationGuest
    ) {
        // Pastikan tamu berasal dari undangan yang benar
        abort_unless(
            $invitationGuest->invitation_id === $invitation->id,
            404
        );

        $invitation->load([
            'template',
            'galleries',
        ]);

        if ($invitation->status !== 'active') {
            abort(404);
        }

        if (
            $invitation->expired_at &&
            now()->greaterThan($invitation->expired_at)
        ) {
            abort(404);
        }

        if (!$invitation->template) {
            abort(404, 'Template undangan tidak ditemukan.');
        }

        $templatePath = $invitation->template->path;

        if (!view()->exists($templatePath)) {
            abort(404, 'File template tidak ditemukan.');
        }

        return view(
            $templatePath,
            compact('invitation', 'invitationGuest')
        );
    }
}
