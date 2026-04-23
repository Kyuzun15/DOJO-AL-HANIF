document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('agendaSliderTrack');
    const container = document.getElementById('agendaSliderContainer');
    
    if (track && container) {
        const cards = track.querySelectorAll('.agenda-card');
        if (cards.length < 3) {
            // Logic centering sudah dihandle oleh CSS class .track-centered di Blade
            return;
        }

        let isDragging = false;
        let startX;
        let scrollLeft;
        let autoScrollInterval;
        let currentTranslate = 0;
        let prevTranslate = 0;

        function startAutoScroll() {
            autoScrollInterval = setInterval(() => {
                const card = track.querySelector('.agenda-card');
                if (!card) return;
                const cardWidth = card.offsetWidth;
                currentTranslate -= cardWidth;
                
                track.style.transition = 'transform 0.6s cubic-bezier(0.25, 1, 0.5, 1)';
                track.style.transform = `translateX(${currentTranslate}px)`;
                
                checkBoundary();
            }, 3000);
        }

        function checkBoundary() {
            const totalWidth = track.scrollWidth / 2;
            if (Math.abs(currentTranslate) >= totalWidth) {
                setTimeout(() => {
                    track.style.transition = 'none';
                    currentTranslate = 0;
                    track.style.transform = `translateX(${currentTranslate}px)`;
                }, 600);
            }
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        // Drag / Swipe
        container.addEventListener('mousedown', startDrag);
        window.addEventListener('mousemove', drag);
        window.addEventListener('mouseup', endDrag);
        
        container.addEventListener('touchstart', startDrag);
        container.addEventListener('touchmove', drag);
        container.addEventListener('touchend', endDrag);

        function startDrag(e) {
            isDragging = true;
            startX = getPositionX(e);
            prevTranslate = currentTranslate;
            stopAutoScroll();
            track.style.transition = 'none';
        }

        function drag(e) {
            if (!isDragging) return;
            const currentX = getPositionX(e);
            const walk = currentX - startX;
            currentTranslate = prevTranslate + walk;
            track.style.transform = `translateX(${currentTranslate}px)`;
        }

        function endDrag() {
            if (!isDragging) return;
            isDragging = false;
            
            // Snap to nearest card
            const card = track.querySelector('.agenda-card');
            const cardWidth = card.offsetWidth;
            const index = Math.round(currentTranslate / cardWidth);
            currentTranslate = index * cardWidth;
            
            track.style.transition = 'transform 0.3s ease';
            track.style.transform = `translateX(${currentTranslate}px)`;
            
            // Final boundary check
            const totalWidth = track.scrollWidth / 2;
            if (currentTranslate > 0) {
                currentTranslate = -totalWidth;
                track.style.transition = 'none';
                track.style.transform = `translateX(${currentTranslate}px)`;
            } else if (Math.abs(currentTranslate) >= totalWidth) {
                currentTranslate = 0;
                track.style.transition = 'none';
                track.style.transform = `translateX(${currentTranslate}px)`;
            }

            startAutoScroll();
        }

        function getPositionX(e) {
            return e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
        }

        startAutoScroll();
    }
});
