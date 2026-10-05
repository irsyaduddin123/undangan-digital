<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TemplateController extends Controller
{
    /**
     * Menampilkan semua template.
     */
    public function index()
    {
        $templates = Template::latest()->paginate(10);

        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Menampilkan form tambah template.
     */
    public function create()
    {
        return view('admin.templates.create');
    }

    /**
     * Menyimpan template baru.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'slug' => 'nullable|string|max:255|unique:templates,slug',
    //         'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //         'path' => 'required|string|max:255',
    //         'status' => 'required|in:active,inactive',
    //     ]);

    //     $data = $request->only([
    //         'name',
    //         'path',
    //         'status',
    //     ]);

    //     $data['slug'] = $request->slug
    //         ? Str::slug($request->slug)
    //         : Str::slug($request->name);

    //     if ($request->hasFile('thumbnail')) {
    //         $data['thumbnail'] = $request->file('thumbnail')
    //             ->store('templates', 'public');
    //     }

    //     Template::create($data);

    //     return redirect()
    //         ->route('admin.templates.index')
    //         ->with('success', 'Template berhasil ditambahkan.');
    // }

//     public function store(Request $request)
// {
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'slug' => 'nullable|string|max:255|unique:templates,slug',
//         'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
//         'status' => 'required|in:active,inactive',
//     ]);

//     // Buat slug otomatis
//     $slug = $request->slug
//         ? Str::slug($request->slug)
//         : Str::slug($request->name);

//     // Folder template
//     $templateFolder = resource_path('views/templates/' . $slug);

//     // Buat folder jika belum ada
//     if (!File::exists($templateFolder)) {
//         File::makeDirectory($templateFolder, 0755, true);
//     }

//     // Buat file index.blade.php otomatis
//     $bladeFile = $templateFolder . '/index.blade.php';

//     if (!File::exists($bladeFile)) {
//         $content = <<<BLADE
// @extends('layouts.app')

// @section('content')

// <div class="container py-5">
//     <div class="text-center">
//         <h1>{{ \$invitation->groom_name ?? 'Nama Mempelai Pria' }}</h1>

//         <h2>&</h2>

//         <h1>{{ \$invitation->bride_name ?? 'Nama Mempelai Wanita' }}</h1>

//         <p class="mt-3">
//             {{ \$invitation->wedding_date ?? 'Tanggal Pernikahan' }}
//         </p>
//     </div>
// </div>

// @endsection
// BLADE;

//         File::put($bladeFile, $content);
//     }

//     // Upload thumbnail
//     $thumbnail = null;

//     if ($request->hasFile('thumbnail')) {
//         $thumbnail = $request->file('thumbnail')
//             ->store('templates', 'public');
//     }

//     // Simpan database
//     Template::create([
//         'name' => $request->name,
//         'slug' => $slug,
//         'thumbnail' => $thumbnail,
//         'path' => 'templates.' . $slug . '.index',
//         'status' => $request->status,
//     ]);

//     return redirect()
//         ->route('admin.templates.index')
//         ->with('success', 'Template berhasil ditambahkan.');
// }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:templates,slug',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        // Generate slug
        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        // ==========================================
        // BUAT STRUKTUR FOLDER TEMPLATE
        // ==========================================

        $templateFolder = resource_path('views/templates/' . $slug);

        $cssFolder = $templateFolder . '/css';
        $jsFolder = $templateFolder . '/js';
        $imagesFolder = $templateFolder . '/images';

        // Buat folder
        File::makeDirectory($templateFolder, 0755, true, true);
        File::makeDirectory($cssFolder, 0755, true, true);
        File::makeDirectory($jsFolder, 0755, true, true);
        File::makeDirectory($imagesFolder, 0755, true, true);

        // ==========================================
        // BUAT INDEX.BLADE.PHP
        // ==========================================

        $bladeFile = $templateFolder . '/index.blade.php';

        if (!File::exists($bladeFile)) {

            $bladeContent = <<<'BLADE'
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $invitation->groom_name ?? 'Mempelai Pria' }}
        &
        {{ $invitation->bride_name ?? 'Mempelai Wanita' }}
    </title>

    <link rel="stylesheet"
          href="{{ asset('storage/templates/TEMPLATE_SLUG/css/style.css') }}">
</head>

<body>

    <section class="hero">

        <p class="subtitle">
            The Wedding Of
        </p>

        <h1>
            {{ $invitation->groom_name ?? 'Nama Pria' }}
        </h1>

        <span>&</span>

        <h1>
            {{ $invitation->bride_name ?? 'Nama Wanita' }}
        </h1>

        <p class="date">
            {{ $invitation->wedding_date ?? 'Tanggal Pernikahan' }}
        </p>

    </section>

    <script src="{{ asset('storage/templates/TEMPLATE_SLUG/js/script.js') }}"></script>

</body>

</html>
BLADE;

            $bladeContent = str_replace(
                'TEMPLATE_SLUG',
                $slug,
                $bladeContent
            );

            File::put($bladeFile, $bladeContent);
        }

        // ==========================================
        // BUAT CSS
        // ==========================================

        $cssFile = $cssFolder . '/style.css';

        if (!File::exists($cssFile)) {

            $cssContent = <<<'CSS'
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Georgia, serif;
    background: #f8f5f0;
    color: #333;
}

.hero {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 30px;
}

.subtitle {
    font-size: 18px;
    letter-spacing: 3px;
    margin-bottom: 25px;
}

.hero h1 {
    font-size: 48px;
    font-weight: normal;
    margin: 5px 0;
}

.hero span {
    font-size: 30px;
    margin: 10px 0;
}

.date {
    margin-top: 30px;
    font-size: 18px;
}

@media (max-width: 768px) {

    .hero h1 {
        font-size: 36px;
    }

    .subtitle {
        font-size: 15px;
    }
}
CSS;

            File::put($cssFile, $cssContent);
        }

        // ==========================================
        // BUAT JAVASCRIPT
        // ==========================================

        $jsFile = $jsFolder . '/script.js';

        if (!File::exists($jsFile)) {

            $jsContent = <<<'JS'
document.addEventListener('DOMContentLoaded', function () {

    console.log('Template invitation loaded.');

});
JS;

            File::put($jsFile, $jsContent);
        }

        // ==========================================
        // UPLOAD THUMBNAIL
        // ==========================================

        $thumbnail = null;

        if ($request->hasFile('thumbnail')) {

            $thumbnail = $request->file('thumbnail')
                ->store('templates', 'public');
        }

        // ==========================================
        // SIMPAN TEMPLATE KE DATABASE
        // ==========================================

        Template::create([
            'name' => $request->name,
            'slug' => $slug,
            'thumbnail' => $thumbnail,
            'path' => 'templates.' . $slug . '.index',
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail template.
     */
    public function show(Template $template)
    {
        return view('admin.templates.show', compact('template'));
    }

    /**
     * Menampilkan form edit template.
     */
    public function edit(Template $template)
    {
        return view('admin.templates.edit', compact('template'));
    }

    /**
     * Mengupdate template.
     */
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:templates,slug,' . $template->id,
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'path' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->only([
            'name',
            'path',
            'status',
        ]);

        $data['slug'] = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->name);

        if ($request->hasFile('thumbnail')) {

            // Hapus thumbnail lama
            if ($template->thumbnail && Storage::disk('public')->exists($template->thumbnail)) {
                Storage::disk('public')->delete($template->thumbnail);
            }

            // Simpan thumbnail baru
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('templates', 'public');
        }

        $template->update($data);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    /**
     * Menghapus template.
     */
    public function destroy(Template $template)
    {
        if ($template->thumbnail && Storage::disk('public')->exists($template->thumbnail)) {
            Storage::disk('public')->delete($template->thumbnail);
        }

        $template->delete();

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil dihapus.');
    }
}