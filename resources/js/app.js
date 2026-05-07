import './bootstrap';

/* View Transitions - Livewire handles the hard part, we just trigger it */
if (document.startViewTransition) {
    let isTransitioning = false;

    document.addEventListener('livewire:navigating', () => {
        if (!isTransitioning) {
            isTransitioning = true;
            document.startViewTransition(() => {
                isTransitioning = false;
            });
        }
    });
}