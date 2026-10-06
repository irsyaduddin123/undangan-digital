<?php

namespace App\Http\Controllers;

use App\Models\Invitation;

class PublicInvitationController extends Controller
{
    public function show(Invitation $invitation)
    {
        // Pastikan relasi template ikut diambil
        $invitation->load([
            'template',
            'galleries',
        ]);

        // Cek status
        if ($invitation->status !== 'active') {
            abort(404);
        }

        // Cek expired
        if (
            $invitation->expired_at &&
            now()->greaterThan($invitation->expired_at)
        ) {
            abort(404);
        }

        // Pastikan template tersedia
        if (!$invitation->template) {
            abort(404, 'Template undangan tidak ditemukan.');
        }

        // Ambil path template dari database
        $templatePath = $invitation->template->path;

        // Pastikan view tersedia
        if (!view()->exists($templatePath)) {
            abort(404, 'File template tidak ditemukan.');
        }

        // Tampilkan template
        return view(
            $templatePath,
            compact('invitation')
        );
    }
}