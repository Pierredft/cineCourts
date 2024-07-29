document.addEventListener('DOMContentLoaded', function() {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        modal.addEventListener('shown.bs.modal', function(event) {
            var video = modal.querySelector('video');
            if (video) {
                video.muted = false;
                video.play();
            }
        });

        modal.addEventListener('hidden.bs.modal', function(event) {
            var video = modal.querySelector('video');
            if (video) {
                video.pause();
                video.currentTime = 0;
            }
        });
    });
});