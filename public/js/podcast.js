        // YouTube Modal functionality
        const modal = document.getElementById('youtubeModal');
        const player = document.getElementById('youtubePlayer');
        const closeModal = document.querySelector('.close-modal');
        const playButtons = document.querySelectorAll('.play-button');

        playButtons.forEach(button => {
            button.addEventListener('click', function() {
                const youtubeId = this.getAttribute('data-youtube-id');
                player.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1`;
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });

        closeModal.addEventListener('click', function() {
            modal.style.display = 'none';
            player.src = '';
            document.body.style.overflow = 'auto';
        });

        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                player.src = '';
                document.body.style.overflow = 'auto';
            }
        });