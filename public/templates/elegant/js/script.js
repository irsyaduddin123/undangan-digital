document.addEventListener('DOMContentLoaded', function () {

    const openButton = document.getElementById('openInvitation');
    const openingScreen = document.getElementById('openingScreen');
    const invitationContent = document.getElementById('invitationContent');

    // Halaman dikunci ketika pertama dibuka
    document.body.style.overflow = 'hidden';

    openButton.addEventListener('click', function () {

        openingScreen.classList.add('closed');

        setTimeout(function () {

            invitationContent.classList.add('show');

            document.body.style.overflow = 'auto';

        }, 500);

    });

});