<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function create()
    {
        $templates = Template::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'customer.invitations.create',
            compact('templates')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'template_id' => ['required', 'exists:templates,id'],
            'groom_name' => ['required', 'string', 'max:255'],
            'bride_name' => ['required', 'string', 'max:255'],
            'wedding_date' => ['required', 'date'],
            'akad_date' => ['nullable', 'date'],
            'reception_date' => ['nullable', 'date'],
            'location_name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'google_maps' => ['nullable', 'url', 'max:1000'],
            'cover_image' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'
            ],
            'groom_photo' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'
            ],
            'bride_photo' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'
            ],
            'groom_profile' => ['nullable', 'string'],
            'bride_profile' => ['nullable', 'string'],
            'love_story' => ['nullable', 'string'],
            'music' => [
                'nullable', 'file', 'mimes:mp3,wav,ogg', 'max:10240'
            ],
        ]);

        // Pastikan template yang dipilih masih aktif.
        $template = Template::where('status', 'active')
            ->findOrFail($validated['template_id']);

        // Membuat slug unik berdasarkan nama mempelai.
        $baseSlug = Str::slug(
            $validated['groom_name'] . '-' . $validated['bride_name']
        );

        $slug = $baseSlug;
        $counter = 1;

        while (Invitation::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        // Upload file jika tersedia.
        $coverImage = $request->hasFile('cover_image')
            ? $request->file('cover_image')->store('invitations/covers', 'public')
            : null;

        $groomPhoto = $request->hasFile('groom_photo')
            ? $request->file('groom_photo')->store('invitations/couple', 'public')
            : null;

        $bridePhoto = $request->hasFile('bride_photo')
            ? $request->file('bride_photo')->store('invitations/couple', 'public')
            : null;

        $music = $request->hasFile('music')
            ? $request->file('music')->store('invitations/music', 'public')
            : null;

        Invitation::create([
            'user_id' => auth()->id(),
            'template_id' => $template->id,
            'slug' => $slug,
            'groom_name' => $validated['groom_name'],
            'bride_name' => $validated['bride_name'],
            'groom_photo' => $groomPhoto,
            'bride_photo' => $bridePhoto,
            'groom_profile' => $validated['groom_profile'] ?? null,
            'bride_profile' => $validated['bride_profile'] ?? null,
            'love_story' => $validated['love_story'] ?? null,
            'wedding_date' => $validated['wedding_date'],
            'akad_date' => $validated['akad_date'] ?? null,
            'reception_date' => $validated['reception_date'] ?? null,
            'location_name' => $validated['location_name'],
            'address' => $validated['address'] ?? null,
            'google_maps' => $validated['google_maps'] ?? null,
            'cover_image' => $coverImage,
            'music' => $music,
            'status' => 'active',
        ]);

        return redirect()
            ->route('customer.invitations')
            ->with('success', 'Undangan berhasil dibuat.');
    }
}
