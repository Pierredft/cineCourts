document.querySelectorAll('.film-slide').forEach(slide => {
    slide.addEventListener('mouseover', () => {
        const video = slide.querySelector('.video-background');
        if (video) {
            video.play();
        }
    });

    slide.addEventListener('mouseout', () => {
        const video = slide.querySelector('.video-background');
        if (video) {
            video.pause();
            video.currentTime = 0;
        }
    });
});