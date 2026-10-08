<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Invitation $invitation)
    {
        $invitation->load('galleries');

        return view(
            'admin.galleries.index',
            compact('invitation')
        );
    }

    public function store(
        Request $request,
        Invitation $invitation
    ) {
        $request->validate([
            'images' => [
                'required',
                'array',
                'min:1'
            ],

            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],
        ]);

        foreach ($request->file('images') as $image) {

            $path = $image->store(
                'invitations/galleries',
                'public'
            );

            Gallery::create([
                'invitation_id' => $invitation->id,
                'image' => $path,
            ]);
        }

        return redirect()
            ->route(
                'admin.invitations.galleries.index',
                $invitation
            )
            ->with(
                'success',
                'Foto galeri berhasil ditambahkan.'
            );
    }

    public function destroy(Gallery $gallery)
    {
        if (
            $gallery->image &&
            Storage::disk('public')->exists(
                $gallery->image
            )
        ) {
            Storage::disk('public')->delete(
                $gallery->image
            );
        }

        $invitationId = $gallery->invitation_id;

        $gallery->delete();

        return redirect()
            ->route(
                'admin.invitations.galleries.index',
                $invitationId
            )
            ->with(
                'success',
                'Foto berhasil dihapus.'
            );
    }
}