document.addEventListener('DOMContentLoaded', function () {
    const unmuteButtons = document.querySelectorAll('.unmute-button');
    const muteButtons = document.querySelectorAll('.mute-button');

    unmuteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const videoId = this.getAttribute('data-video-id');
            const video = document.getElementById(videoId);
            if (video) {
                video.muted = false;
                video.play().catch(error => {
                    console.log('La lecture automatique a été bloquée par le navigateur.', error);
                });
                this.style.display = 'none';
                document.querySelector(`.mute-button[data-video-id="${videoId}"]`).style.display = 'inline';
            }
        });
    });

    muteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const videoId = this.getAttribute('data-video-id');
            const video = document.getElementById(videoId);
            if (video) {
                video.muted = true;
                this.style.display = 'none';
                document.querySelector(`.unmute-button[data-video-id="${videoId}"]`).style.display = 'inline';
            }
        });
    });
});