document.addEventListener('DOMContentLoaded', (event) => {
    const video = document.querySelector('video');
    const videoId = video.dataset.videoId;

    // Récupérer la progression de l'utilisateur au chargement de la page
    fetch(`/video/${videoId}/progress`)
        .then(response => response.json())
        .then(data => {
            video.currentTime = data.lastWatchedTimestamp;
        });

    // Sauvegarder la progression à intervalles réguliers
    video.addEventListener('timeupdate', () => {
        const lastWatchedTimestamp = Math.floor(video.currentTime);

        fetch(`/video/${videoId}/save-progress`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ lastWatchedTimestamp: lastWatchedTimestamp }),
        });
    });
});
