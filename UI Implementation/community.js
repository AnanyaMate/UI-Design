document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.follow-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userid;
            const isFollowing = this.dataset.following === 'true';

            fetch('follow_toggle.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ userId, follow: !isFollowing }) // Send the opposite of the current state
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Toggle the button state based on the response
                    if (isFollowing) {
                        this.textContent = 'Follow';
                        this.dataset.following = 'false';
                    } else {
                        this.textContent = 'Unfollow';
                        this.dataset.following = 'true';
                    }
                } else {
                    console.error('Failed to toggle follow state:', data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
