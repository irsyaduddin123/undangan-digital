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

        return view(
            'admin.templates.index',
            compact('templates')
        );
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:templates,slug',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        // ==========================================
        // GENERATE SLUG
        // ==========================================

        $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->name);


        // ==========================================
        // FOLDER BLADE TEMPLATE
        // ==========================================

        $templateFolder = resource_path(
            'views/templates/' . $slug
        );


        // ==========================================
        // FOLDER ASSET TEMPLATE
        // ==========================================

        $assetFolder = public_path(
            'templates/' . $slug
        );

        $cssFolder = $assetFolder . '/css';
        $jsFolder = $assetFolder . '/js';
        $imagesFolder = $assetFolder . '/images';


        // ==========================================
        // BUAT FOLDER
        // ==========================================

        File::makeDirectory(
            $templateFolder,
            0755,
            true,
            true
        );

        File::makeDirectory(
            $cssFolder,
            0755,
            true,
            true
        );

        File::makeDirectory(
            $jsFolder,
            0755,
            true,
            true
        );

        File::makeDirectory(
            $imagesFolder,
            0755,
            true,
            true
        );


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

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        {{ $invitation->groom_name ?? 'Mempelai Pria' }}
        &
        {{ $invitation->bride_name ?? 'Mempelai Wanita' }}
    </title>

    <link rel="stylesheet"
          href="{{ asset('templates/TEMPLATE_SLUG/css/style.css') }}">

</head>

<body>

    <section class="hero">

        <p class="subtitle">
            The Wedding Of
        </p>

        <h1>
            {{ $invitation->groom_name ?? 'Nama Pria' }}
        </h1>

        <span>
            &
        </span>

        <h1>
            {{ $invitation->bride_name ?? 'Nama Wanita' }}
        </h1>

        <p class="date">

            {{ $invitation->wedding_date?->translatedFormat('d F Y')
                ?? 'Tanggal Pernikahan' }}

        </p>

    </section>


    <script src="{{ asset('templates/TEMPLATE_SLUG/js/script.js') }}">
    </script>

</body>

</html>
BLADE;

            $bladeContent = str_replace(
                'TEMPLATE_SLUG',
                $slug,
                $bladeContent
            );

            File::put(
                $bladeFile,
                $bladeContent
            );
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

            File::put(
                $cssFile,
                $cssContent
            );
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

            File::put(
                $jsFile,
                $jsContent
            );
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
        // SIMPAN DATABASE
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
            ->with(
                'success',
                'Template berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan form edit template.
     */
    public function edit(Template $template)
    {
        return view(
            'admin.templates.edit',
            compact('template')
        );
    }


    /**
     * Mengupdate template.
     */
    public function update(
        Request $request,
        Template $template
    ) {

        $request->validate([

            'name' => 'required|string|max:255',

            'slug' =>
                'nullable|string|max:255|unique:templates,slug,' .
                $template->id,

            'thumbnail' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' =>
                'required|in:active,inactive',

        ]);


        // ==========================================
        // SLUG LAMA
        // ==========================================

        $oldSlug = $template->slug;


        // ==========================================
        // SLUG BARU
        // ==========================================

        $newSlug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->name);


        // ==========================================
        // PINDAHKAN FOLDER JIKA SLUG BERUBAH
        // ==========================================

        if ($oldSlug !== $newSlug) {

            // ------------------------------
            // Folder Blade
            // ------------------------------

            $oldTemplateFolder = resource_path(
                'views/templates/' . $oldSlug
            );

            $newTemplateFolder = resource_path(
                'views/templates/' . $newSlug
            );


            if (
                File::exists($oldTemplateFolder) &&
                !File::exists($newTemplateFolder)
            ) {

                File::moveDirectory(
                    $oldTemplateFolder,
                    $newTemplateFolder
                );
            }


            // ------------------------------
            // Folder Asset
            // ------------------------------

            $oldAssetFolder = public_path(
                'templates/' . $oldSlug
            );

            $newAssetFolder = public_path(
                'templates/' . $newSlug
            );


            if (
                File::exists($oldAssetFolder) &&
                !File::exists($newAssetFolder)
            ) {

                File::moveDirectory(
                    $oldAssetFolder,
                    $newAssetFolder
                );
            }


            // ------------------------------
            // Update URL CSS & JS
            // ------------------------------

            $newBladeFile =
                $newTemplateFolder . '/index.blade.php';


            if (File::exists($newBladeFile)) {

                $bladeContent = File::get(
                    $newBladeFile
                );

                $bladeContent = str_replace(
                    $oldSlug,
                    $newSlug,
                    $bladeContent
                );

                File::put(
                    $newBladeFile,
                    $bladeContent
                );
            }
        }


        // ==========================================
        // THUMBNAIL
        // ==========================================

        $thumbnail = $template->thumbnail;


        if ($request->hasFile('thumbnail')) {

            if (
                $template->thumbnail &&
                Storage::disk('public')
                    ->exists($template->thumbnail)
            ) {

                Storage::disk('public')
                    ->delete($template->thumbnail);
            }


            $thumbnail =
                $request->file('thumbnail')
                    ->store(
                        'templates',
                        'public'
                    );
        }


        // ==========================================
        // UPDATE DATABASE
        // ==========================================

        $template->update([

            'name' =>
                $request->name,

            'slug' =>
                $newSlug,

            'thumbnail' =>
                $thumbnail,

            'path' =>
                'templates.' .
                $newSlug .
                '.index',

            'status' =>
                $request->status,

        ]);


        return redirect()
            ->route('admin.templates.index')
            ->with(
                'success',
                'Template berhasil diperbarui.'
            );
    }


    /**
     * Menghapus template.
     */
    public function destroy(Template $template)
    {

        // ==========================================
        // HAPUS THUMBNAIL
        // ==========================================

        if (
            $template->thumbnail &&
            Storage::disk('public')
                ->exists($template->thumbnail)
        ) {

            Storage::disk('public')
                ->delete($template->thumbnail);
        }


        // ==========================================
        // HAPUS FOLDER BLADE
        // ==========================================

        $templateFolder = resource_path(
            'views/templates/' . $template->slug
        );


        if (File::exists($templateFolder)) {

            File::deleteDirectory(
                $templateFolder
            );
        }


        // ==========================================
        // HAPUS FOLDER ASSET
        // ==========================================

        $assetFolder = public_path(
            'templates/' . $template->slug
        );


        if (File::exists($assetFolder)) {

            File::deleteDirectory(
                $assetFolder
            );
        }


        // ==========================================
        // HAPUS DATABASE
        // ==========================================

        $template->delete();


        return redirect()
            ->route('admin.templates.index')
            ->with(
                'success',
                'Template berhasil dihapus.'
            );
    }
}