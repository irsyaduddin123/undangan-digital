<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $invitation->groom_name }}
        &
        {{ $invitation->bride_name }}
    </title>

    <link rel="stylesheet"
          href="{{ asset('templates/elegant/css/style.css') }}">
</head>

<body>

    {{-- =========================
        COVER / OPENING
    ========================== --}}
    <section class="opening-screen" id="openingScreen">

        <div class="opening-overlay"></div>

        <div class="opening-content">

            <p class="opening-subtitle">
                THE WEDDING OF
            </p>

            <h1 class="opening-name">
                {{ $invitation->groom_name }}
            </h1>

            <div class="opening-and">
                &
            </div>

            <h1 class="opening-name">
                {{ $invitation->bride_name }}
            </h1>

            <p class="opening-date">
                {{ $invitation->wedding_date?->translatedFormat('d F Y') }}
            </p>

            <button
                type="button"
                class="open-button"
                id="openInvitation">

                <span>✉</span>
                Buka Undangan

            </button>

        </div>

    </section>


    {{-- =========================
        MAIN INVITATION
    ========================== --}}
    <main class="invitation-content" id="invitationContent">

        <section class="hero">

            <p class="subtitle">
                The Wedding Of
            </p>

            <h1>
                {{ $invitation->groom_name }}
            </h1>

            <span>&</span>

            <h1>
                {{ $invitation->bride_name }}
            </h1>

            <p class="date">
                {{ $invitation->wedding_date?->translatedFormat('d F Y') }}
            </p>

        </section>

    </main>


    <script src="{{ asset('templates/elegant/js/script.js') }}"></script>

</body>

</html>