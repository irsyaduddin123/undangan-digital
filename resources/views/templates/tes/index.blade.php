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
          href="{{ asset('storage/templates/tes/css/style.css') }}">
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

    <script src="{{ asset('storage/templates/tes/js/script.js') }}"></script>

</body>

</html>