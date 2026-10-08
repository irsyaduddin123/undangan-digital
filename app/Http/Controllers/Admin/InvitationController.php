<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $invitations = Invitation::with([
            'user',
            'template'
        ])
        ->latest()
        ->paginate(10);

        return view(
            'admin.invitations.index',
            compact('invitations')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $customers = User::where('role', 'customer')
            ->orderBy('name')
            ->get();

        $templates = Template::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'admin.invitations.create',
            compact(
                'customers',
                'templates'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'user_id' => [
                'required',
                'exists:users,id'
            ],

            'template_id' => [
                'required',
                'exists:templates,id'
            ],

            'groom_name' => [
                'required',
                'string',
                'max:255'
            ],

            'bride_name' => [
                'required',
                'string',
                'max:255'
            ],

            'groom_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'bride_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'groom_profile' => [
                'nullable',
                'string'
            ],

            'bride_profile' => [
                'nullable',
                'string'
            ],

            'love_story' => [
                'nullable',
                'string'
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:invitations,slug'
            ],

            'wedding_date' => [
                'required',
                'date'
            ],

            'akad_date' => [
                'nullable',
                'date'
            ],

            'reception_date' => [
                'nullable',
                'date'
            ],

            'location_name' => [
                'required',
                'string',
                'max:255'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'google_maps' => [
                'nullable',
                'url',
                'max:1000'
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'music' => [
                'nullable',
                'mimes:mp3,wav,ogg',
                'max:10240'
            ],

            'status' => [
                'required',
                'in:active,inactive'
            ],

            'expired_at' => [
                'nullable',
                'date'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug(
                $request->groom_name .
                '-' .
                $request->bride_name
            );


        /*
        |--------------------------------------------------------------------------
        | COVER IMAGE
        |--------------------------------------------------------------------------
        */

        $coverImage = null;

        if ($request->hasFile('cover_image')) {

            $coverImage = $request
                ->file('cover_image')
                ->store(
                    'invitations/covers',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | MUSIC
        |--------------------------------------------------------------------------
        */

        $music = null;

        if ($request->hasFile('music')) {

            $music = $request
                ->file('music')
                ->store(
                    'invitations/music',
                    'public'
                );
        }

        /*love stroy*/

        $groomPhoto = null;

        if ($request->hasFile('groom_photo')) {
            $groomPhoto = $request->file('groom_photo')
                ->store('invitations/couple', 'public');
        }

        $bridePhoto = null;

        if ($request->hasFile('bride_photo')) {
            $bridePhoto = $request->file('bride_photo')
                ->store('invitations/couple', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE INVITATION
        |--------------------------------------------------------------------------
        */

        Invitation::create([

            'user_id' => $request->user_id,

            'template_id' => $request->template_id,

            'slug' => $slug,

            'groom_name' => $request->groom_name,

            'bride_name' => $request->bride_name,

            'groom_photo' => $groomPhoto,

            'bride_photo' => $bridePhoto,

            'groom_profile' => $request->groom_profile,

            'bride_profile' => $request->bride_profile,

            'love_story' => $request->love_story,

            'wedding_date' => $request->wedding_date,

            'akad_date' => $request->akad_date,

            'reception_date' => $request->reception_date,

            'location_name' => $request->location_name,

            'address' => $request->address,

            'google_maps' => $request->google_maps,

            'cover_image' => $coverImage,

            'music' => $music,

            'status' => $request->status,

            'expired_at' => $request->expired_at,

        ]);


        return redirect()
            ->route('admin.invitations.index')
            ->with(
                'success',
                'Undangan berhasil ditambahkan.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Invitation $invitation)
    {
        $customers = User::where('role', 'customer')
            ->orderBy('name')
            ->get();

        $templates = Template::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view(
            'admin.invitations.edit',
            compact(
                'invitation',
                'customers',
                'templates'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Invitation $invitation
    ) {

        $request->validate([

            'user_id' => [
                'required',
                'exists:users,id'
            ],

            'template_id' => [
                'required',
                'exists:templates,id'
            ],

            'groom_name' => [
                'required',
                'string',
                'max:255'
            ],

            'bride_name' => [
                'required',
                'string',
                'max:255'
            ],

            'groom_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'bride_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'groom_profile' => [
                'nullable',
                'string'
            ],

            'bride_profile' => [
                'nullable',
                'string'
            ],

            'love_story' => [
                'nullable',
                'string'
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:invitations,slug,' . $invitation->id
            ],

            'wedding_date' => [
                'required',
                'date'
            ],

            'akad_date' => [
                'nullable',
                'date'
            ],

            'reception_date' => [
                'nullable',
                'date'
            ],

            'location_name' => [
                'required',
                'string',
                'max:255'
            ],

            'address' => [
                'nullable',
                'string'
            ],

            'google_maps' => [
                'nullable',
                'url',
                'max:1000'
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'music' => [
                'nullable',
                'mimes:mp3,wav,ogg',
                'max:10240'
            ],

            'status' => [
                'required',
                'in:active,inactive'
            ],

            'expired_at' => [
                'nullable',
                'date'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug(
                $request->groom_name .
                '-' .
                $request->bride_name
            );


        /*
        |--------------------------------------------------------------------------
        | COVER IMAGE
        |--------------------------------------------------------------------------
        */

        $coverImage = $invitation->cover_image;

        if ($request->hasFile('cover_image')) {

            if (
                $invitation->cover_image &&
                Storage::disk('public')
                    ->exists(
                        $invitation->cover_image
                    )
            ) {

                Storage::disk('public')
                    ->delete(
                        $invitation->cover_image
                    );
            }

            $coverImage = $request
                ->file('cover_image')
                ->store(
                    'invitations/covers',
                    'public'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | MUSIC
        |--------------------------------------------------------------------------
        */

        $music = $invitation->music;

        if ($request->hasFile('music')) {

            if (
                $invitation->music &&
                Storage::disk('public')
                    ->exists(
                        $invitation->music
                    )
            ) {

                Storage::disk('public')
                    ->delete(
                        $invitation->music
                    );
            }

            $music = $request
                ->file('music')
                ->store(
                    'invitations/music',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | GROOM PHOTO
        |--------------------------------------------------------------------------
        */

        $groomPhoto = $invitation->groom_photo;

        if ($request->hasFile('groom_photo')) {
            if (
                $invitation->groom_photo &&
                Storage::disk('public')->exists($invitation->groom_photo)
            ) {
                Storage::disk('public')->delete(
                    $invitation->groom_photo
                );
            }

            $groomPhoto = $request->file('groom_photo')
                ->store('invitations/couple', 'public');
        }

        $bridePhoto = $invitation->bride_photo;

        if ($request->hasFile('bride_photo')) {
            if (
                $invitation->bride_photo &&
                Storage::disk('public')->exists($invitation->bride_photo)
            ) {
                Storage::disk('public')->delete(
                    $invitation->bride_photo
                );
            }

            $bridePhoto = $request->file('bride_photo')
                ->store('invitations/couple', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $invitation->update([

            'user_id' => $request->user_id,

            'template_id' => $request->template_id,

            'slug' => $slug,

            'groom_name' => $request->groom_name,

            'bride_name' => $request->bride_name,

            'groom_photo' => $groomPhoto,
            
            'bride_photo' => $bridePhoto,

            'groom_profile' => $request->groom_profile,

            'bride_profile' => $request->bride_profile,

            'love_story' => $request->love_story,

            'wedding_date' => $request->wedding_date,

            'akad_date' => $request->akad_date,

            'reception_date' => $request->reception_date,

            'location_name' => $request->location_name,

            'address' => $request->address,

            'google_maps' => $request->google_maps,

            'cover_image' => $coverImage,

            'music' => $music,

            'status' => $request->status,

            'expired_at' => $request->expired_at,

        ]);


        return redirect()
            ->route('admin.invitations.index')
            ->with(
                'success',
                'Undangan berhasil diperbarui.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Invitation $invitation)
    {
        if (
            $invitation->cover_image &&
            Storage::disk('public')
                ->exists(
                    $invitation->cover_image
                )
        ) {

            Storage::disk('public')
                ->delete(
                    $invitation->cover_image
                );
        }


        if (
            $invitation->music &&
            Storage::disk('public')
                ->exists(
                    $invitation->music
                )
        ) {

            Storage::disk('public')
                ->delete(
                    $invitation->music
                );
        }

        if (
            $invitation->groom_photo &&
            Storage::disk('public')->exists($invitation->groom_photo)
        ) {
            Storage::disk('public')->delete(
                $invitation->groom_photo
            );
        }

        if (
            $invitation->bride_photo &&
            Storage::disk('public')->exists($invitation->bride_photo)
        ) {
            Storage::disk('public')->delete(
                $invitation->bride_photo
            );
        }


        $invitation->delete();


        return redirect()
            ->route('admin.invitations.index')
            ->with(
                'success',
                'Undangan berhasil dihapus.'
            );
    }
}