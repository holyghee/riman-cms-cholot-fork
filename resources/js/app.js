import './bootstrap';

// Hero Video Auto-Play Setup
document.addEventListener('DOMContentLoaded', function() {
    const heroVideos = document.querySelectorAll('.cholot-hero-video');
    
    heroVideos.forEach(video => {
        // Stelle sicher, dass das Video alle erforderlichen Attribute hat
        video.autoplay = true;
        video.muted = true;
        video.loop = true;
        video.playsInline = true;
        video.controls = false;
        
        // Force play wenn möglich
        const playVideo = () => {
            video.play().catch(error => {
                console.log('Hero video autoplay failed:', error);
                // Fallback: Video stumm schalten und erneut versuchen
                video.muted = true;
                video.play().catch(e => console.log('Second attempt failed:', e));
            });
        };
        
        // Versuche sofort zu spielen
        if (video.readyState >= 3) { // HAVE_FUTURE_DATA
            playVideo();
        } else {
            video.addEventListener('canplay', playVideo, { once: true });
        }
        
        // Stelle sicher, dass das Video nie pausiert
        video.addEventListener('pause', () => {
            video.play();
        });
    });
    
    // Entferne alle Click-Handler für Hero-Videos (verhindert Popup)
    document.querySelectorAll('.cholot-hero .cholot-play-button').forEach(button => {
        button.remove();
    });
    
    document.querySelectorAll('.cholot-hero .cholot-video-overlay').forEach(overlay => {
        overlay.remove();
    });
});
