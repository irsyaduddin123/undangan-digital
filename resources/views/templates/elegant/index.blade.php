<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        {{ $invitation->groom_name }}
        &
        {{ $invitation->bride_name }}
    </title>

    <link rel="stylesheet"
          href="{{ asset('templates/elegant/css/style.css') }}">

</head>


<body>


    {{-- ==========================================
        COVER / OPENING
    =========================================== --}}

    <section
        class="opening-screen"
        id="openingScreen"

        @if($invitation->cover_image)

            style="
                background-image:
                    linear-gradient(
                        rgba(20, 18, 15, 0.45),
                        rgba(20, 18, 15, 0.70)
                    ),
                    url('{{ asset('storage/' . $invitation->cover_image) }}');
            "

        @endif
    >

        <div class="opening-content">

            <p class="opening-small-text">
                THE WEDDING OF
            </p>


            <div class="opening-names">

                <h1>
                    {{ $invitation->groom_name }}
                </h1>

                <div class="opening-ampersand">
                    &
                </div>

                <h1>
                    {{ $invitation->bride_name }}
                </h1>

            </div>


            <div class="opening-line"></div>


            <p class="opening-date">

                {{ $invitation->wedding_date?->translatedFormat('d F Y') }}

            </p>


            <button
                type="button"
                id="openInvitation"
                class="open-button">

                <span class="button-icon">
                    ♡
                </span>

                <span>
                    Buka Undangan
                </span>

            </button>

        </div>

    </section>
        {{-- ==========================================
            BACKGROUND MUSIC
        =========================================== --}}

        @if($invitation->music)

            <audio
                id="bgMusic"
                loop
                preload="auto"
            >
                <source
                    src="{{ asset('storage/' . $invitation->music) }}"
                    type="audio/mpeg"
                >

                Browser Anda tidak mendukung audio.
            </audio>

        @endif


    {{-- ==========================================
        MAIN INVITATION
    =========================================== --}}

    <main
        id="invitationContent"
        class="invitation-content">


        {{-- HERO --}}

        <section class="hero-section">

            <div class="hero-inner">

                <p class="hero-label">
                    THE WEDDING OF
                </p>


                <h1>
                    {{ $invitation->groom_name }}
                </h1>


                <div class="hero-ampersand">
                    &
                </div>


                <h1>
                    {{ $invitation->bride_name }}
                </h1>


                <div class="hero-divider"></div>


                <p class="hero-date">

                    {{ $invitation->wedding_date?->translatedFormat('d F Y') }}

                </p>

            </div>

        </section>

        {{-- ==========================================
            COUNTDOWN
        =========================================== --}}

        <section class="countdown-section">

            <div class="countdown-inner">

                <p class="section-label">
                    COUNTING DOWN TO OUR SPECIAL DAY
                </p>

                <h2>
                    Menuju Hari Bahagia
                </h2>

                <div class="section-divider"></div>


                <div
                    class="countdown"
                    id="countdown"
                    data-date="{{ $invitation->wedding_date?->format('Y-m-d') }}"
                >

                    <div class="countdown-item">

                        <span id="days">
                            00
                        </span>

                        <small>
                            Hari
                        </small>

                    </div>


                    <div class="countdown-item">

                        <span id="hours">
                            00
                        </span>

                        <small>
                            Jam
                        </small>

                    </div>


                    <div class="countdown-item">

                        <span id="minutes">
                            00
                        </span>

                        <small>
                            Menit
                        </small>

                    </div>


                    <div class="countdown-item">

                        <span id="seconds">
                            00
                        </span>

                        <small>
                            Detik
                        </small>

                    </div>

                </div>

            </div>

        </section>

        {{-- QUOTE / AYAT --}}
        <section class="quote-section">

            <div class="quote-inner">

                <span class="quote-mark">“</span>

                <p class="quote-text">
                    Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan
                    untukmu pasangan hidup dari jenismu sendiri, supaya kamu
                    merasa tenteram kepadanya dan dijadikan-Nya di antaramu
                    rasa kasih dan sayang.
                </p>

                <p class="quote-source">
                    QS. Ar-Rum: 21
                </p>

            </div>

        </section>

        {{-- COUPLE PROFILE --}}

                {{-- ==========================================
            PROFIL MEMPELAI
        =========================================== --}}

        <section class="couple-section">

            <div class="couple-inner">

                <p class="section-label">
                    THE HAPPY COUPLE
                </p>

                <h2>
                    Mempelai
                </h2>

                <div class="section-divider"></div>


                <div class="couple-grid">

                    {{-- ==================================
                        MEMPELAI PRIA
                    =================================== --}}

                    <article class="couple-card">

                        <div class="couple-photo">

                            @if($invitation->groom_photo)

                                <img
                                    src="{{ asset('storage/' . $invitation->groom_photo) }}"
                                    alt="{{ $invitation->groom_name }}"
                                    loading="lazy"
                                >

                            @else

                                <div class="couple-photo-empty">
                                    ♡
                                </div>

                            @endif

                        </div>


                        <div class="couple-content">

                            <p class="couple-role">
                                THE GROOM
                            </p>

                            <h3>
                                {{ $invitation->groom_name }}
                            </h3>


                            <div class="couple-line"></div>


                            @if($invitation->groom_profile)

                                <p class="couple-profile">
                                    {{ $invitation->groom_profile }}
                                </p>

                            @endif

                        </div>

                    </article>


                    {{-- AMPERSAND --}}

                    <div class="couple-ampersand">
                        &
                    </div>


                    {{-- ==================================
                        MEMPELAI WANITA
                    =================================== --}}

                    <article class="couple-card">

                        <div class="couple-photo">

                            @if($invitation->bride_photo)

                                <img
                                    src="{{ asset('storage/' . $invitation->bride_photo) }}"
                                    alt="{{ $invitation->bride_name }}"
                                    loading="lazy"
                                >

                            @else

                                <div class="couple-photo-empty">
                                    ♡
                                </div>

                            @endif

                        </div>


                        <div class="couple-content">

                            <p class="couple-role">
                                THE BRIDE
                            </p>

                            <h3>
                                {{ $invitation->bride_name }}
                            </h3>


                            <div class="couple-line"></div>


                            @if($invitation->bride_profile)

                                <p class="couple-profile">
                                    {{ $invitation->bride_profile }}
                                </p>

                            @endif

                        </div>

                    </article>

                </div>

            </div>

        </section>


        {{-- ==========================================
            LOVE STORY
        =========================================== --}}

        @if($invitation->love_story)

            <section class="love-story-section">

                <div class="love-story-inner">

                    <p class="section-label">
                        OUR JOURNEY
                    </p>

                    <h2>
                        Love Story
                    </h2>

                    <div class="section-divider"></div>


                    <div class="love-story-content">

                        <div class="love-story-icon">
                            ♡
                        </div>


                        <div class="love-story-text">

                            {!! nl2br(e($invitation->love_story)) !!}

                        </div>

                    </div>

                </div>

            </section>

        @endif


        {{-- DETAIL ACARA --}}
        <section class="event-section">

            <div class="event-inner">

                <p class="section-label">
                    SAVE THE DATE
                </p>

                <h2>
                    Akad & Resepsi
                </h2>

                <div class="section-divider"></div>


                <div class="event-grid">

                    {{-- AKAD --}}
                    <article class="event-card">

                        <div class="event-icon">
                            ♡
                        </div>

                        <h3>
                            Akad Nikah
                        </h3>

                        @if($invitation->akad_date)

                            <p class="event-date">
                                {{ $invitation->akad_date->translatedFormat('l, d F Y') }}
                            </p>

                            <p class="event-time">
                                {{ $invitation->akad_date->format('H:i') }} WIB
                            </p>

                        @endif

                        <div class="event-line"></div>

                        <p class="event-location">
                            {{ $invitation->location_name }}
                        </p>

                        @if($invitation->address)
                            <p class="event-address">
                                {{ $invitation->address }}
                            </p>
                        @endif

                    </article>


                    {{-- RESEPSI --}}
                    <article class="event-card">

                        <div class="event-icon">
                            ♡
                        </div>

                        <h3>
                            Resepsi
                        </h3>

                        @if($invitation->reception_date)

                            <p class="event-date">
                                {{ $invitation->reception_date->translatedFormat('l, d F Y') }}
                            </p>

                            <p class="event-time">
                                {{ $invitation->reception_date->format('H:i') }} WIB
                            </p>

                        @endif

                        <div class="event-line"></div>

                        <p class="event-location">
                            {{ $invitation->location_name }}
                        </p>

                        @if($invitation->address)
                            <p class="event-address">
                                {{ $invitation->address }}
                            </p>
                        @endif

                    </article>

                </div>


                {{-- GOOGLE MAPS
                @if($invitation->google_maps)

                    <a
                        href="{{ $invitation->google_maps }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="map-button"
                    >
                        <span>⌖</span>
                        Lihat Lokasi
                    </a>

                @endif --}}

            </div>

        </section>

        {{-- GALLERY --}}
        <section class="gallery-section">

            <div class="gallery-inner">

                <p class="section-label">
                    OUR MEMORIES
                </p>

                <h2>
                    Galeri Foto
                </h2>

                <div class="section-divider"></div>


                @if($invitation->galleries->count())

                    <div class="gallery-grid">

                        @foreach($invitation->galleries as $gallery)

                            <div class="gallery-item">

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $gallery->image
                                    ) }}"
                                    alt="Foto {{ $invitation->groom_name }} dan {{ $invitation->bride_name }}"
                                    loading="lazy"
                                >

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="gallery-empty">

                        <span>♡</span>

                        <p>
                            Our beautiful memories
                        </p>

                    </div>

                @endif

            </div>

        </section>

        {{-- MAPS --}}
<section class="map-section">

    <div class="map-inner">

        <p class="section-label">
            OUR LOCATION
        </p>

        <h2>
            Lokasi Acara
        </h2>

        <div class="section-divider"></div>


        @php

            $mapQuery = $invitation->location_name;

            if ($invitation->address) {
                $mapQuery .= ', ' . $invitation->address;
            }

            $mapEmbedUrl =
                'https://www.google.com/maps?q=' .
                urlencode($mapQuery) .
                '&output=embed';

        @endphp


        <div class="map-card">

            {{-- MAP --}}
            <div class="map-frame">

                @if($invitation->location_name)

                    <iframe
                        src="{{ $mapEmbedUrl }}"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                @else

                    <div class="map-placeholder">

                        <div class="map-placeholder-icon">
                            ⌖
                        </div>

                        <p>
                            Lokasi belum tersedia
                        </p>

                    </div>

                @endif

            </div>


            {{-- LOCATION INFO --}}
            <div class="map-info">

                <div class="map-icon">
                    ⌖
                </div>

                <div class="map-text">

                    <h3>
                        {{ $invitation->location_name }}
                    </h3>

                    @if($invitation->address)

                        <p>
                            {{ $invitation->address }}
                        </p>

                    @endif

                </div>

            </div>


            {{-- GOOGLE MAPS BUTTON --}}
            @if($invitation->google_maps)

                <a
                    href="{{ $invitation->google_maps }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="map-open-button"
                >
                    <span>⌖</span>
                    Buka Google Maps
                </a>

            @endif

        </div>

    </div>

</section>


    </main>



    <script src="{{ asset('templates/elegant/js/script.js') }}"></script>

</body>

</html>