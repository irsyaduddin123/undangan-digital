document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | OPEN INVITATION
    |--------------------------------------------------------------------------
    */

    const openButton =
        document.getElementById('openInvitation');

    const openingScreen =
        document.getElementById('openingScreen');

    const invitationContent =
        document.getElementById('invitationContent');


    document.body.style.overflow = 'hidden';


    if (openButton) {

        openButton.addEventListener('click', function () {

            // Play Music
            if (bgMusic){
                bgMusic.volume = 0.5;
                bgMusic.play()
                
                .then(function () {
                    console.log('Music is playing');
            })
            .catch(function (error) {
                console.log('Music tidak dapat diputar:', error);
            });
        }

            openingScreen.classList.add('closed');

            setTimeout(function () {

                invitationContent.classList.add('show');

                document.body.style.overflow = 'auto';

            }, 500);

        });

    }


    /*
    |--------------------------------------------------------------------------
    | COUNTDOWN
    |--------------------------------------------------------------------------
    */

    const countdown =
        document.getElementById('countdown');


    if (!countdown) {
        return;
    }


    const weddingDate =
        countdown.dataset.date;


    if (!weddingDate) {
        return;
    }


    const targetDate =
        new Date(
            weddingDate + 'T00:00:00'
        ).getTime();


    function updateCountdown() {

        const now =
            new Date().getTime();


        const distance =
            targetDate - now;


        if (distance <= 0) {

            document.getElementById('days')
                .textContent = '00';

            document.getElementById('hours')
                .textContent = '00';

            document.getElementById('minutes')
                .textContent = '00';

            document.getElementById('seconds')
                .textContent = '00';

            return;

        }


        const days =
            Math.floor(
                distance /
                (1000 * 60 * 60 * 24)
            );


        const hours =
            Math.floor(
                (distance %
                    (1000 * 60 * 60 * 24)
                ) /
                (1000 * 60 * 60)
            );


        const minutes =
            Math.floor(
                (distance %
                    (1000 * 60 * 60)
                ) /
                (1000 * 60)
            );


        const seconds =
            Math.floor(
                (distance %
                    (1000 * 60)
                ) /
                1000
            );


        document.getElementById('days')
            .textContent =
            String(days).padStart(2, '0');


        document.getElementById('hours')
            .textContent =
            String(hours).padStart(2, '0');


        document.getElementById('minutes')
            .textContent =
            String(minutes).padStart(2, '0');


        document.getElementById('seconds')
            .textContent =
            String(seconds).padStart(2, '0');

    }


    updateCountdown();


    setInterval(
        updateCountdown,
        1000
    );

});