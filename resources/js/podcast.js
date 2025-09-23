document.addEventListener('DOMContentLoaded', function() {
    // YouTube Modal functionality
    const modal = document.getElementById('youtubeModal');
    const player = document.getElementById('youtubePlayer');
    const closeModal = document.querySelector('.close-modal');
    
    // Add click event to all play buttons
    const playButtons = document.querySelectorAll('.play-button');
    playButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Get YouTube ID from data attribute
            const youtubeId = this.getAttribute('data-youtube-id');
            
            if (youtubeId) {
                // Set video source with autoplay
                player.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1&rel=0&modestbranding=1`;
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        });
    });
    
    // Close modal functionality
    if (closeModal) {
        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            player.src = '';
            document.body.style.overflow = 'auto';
        });
    }
    
    // Close modal when clicking outside
    if (modal) {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                player.src = '';
                document.body.style.overflow = 'auto';
            }
        });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal && modal.style.display === 'block') {
            modal.style.display = 'none';
            player.src = '';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Pause video when modal is closed
    function stopVideo() {
        if (player) {
            player.src = '';
        }
    }
});