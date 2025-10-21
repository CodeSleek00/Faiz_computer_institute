document.addEventListener('DOMContentLoaded', () => {
    // ---------------- Mobile Menu ----------------
    const mobileToggle = document.getElementById('mobileToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileClose = document.getElementById('mobileClose');
    const overlay = document.getElementById('overlay');

    function openMobileMenu() {
        mobileMenu.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
        document.querySelectorAll('.mobile-dropdown').forEach(dd => dd.classList.remove('active'));
        document.querySelectorAll('.mobile-menu-header-item').forEach(header => header.classList.remove('active'));
    }

    function toggleMobileMenu() {
        mobileMenu.classList.contains('active') ? closeMobileMenu() : openMobileMenu();
    }

    mobileToggle.addEventListener('click', toggleMobileMenu);
    mobileClose.addEventListener('click', closeMobileMenu);
    overlay.addEventListener('click', closeMobileMenu);

    // Close dropdowns when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('#mobileMenu') && !e.target.closest('#mobileToggle')) {
            document.querySelectorAll('.mobile-dropdown').forEach(dd => dd.classList.remove('active'));
            document.querySelectorAll('.mobile-menu-header-item').forEach(header => header.classList.remove('active'));
        }
    });

    // Mobile Dropdowns
    const mobileHeaders = document.querySelectorAll('.mobile-menu-header-item');
    mobileHeaders.forEach(header => {
        header.addEventListener('click', (e) => {
            e.stopPropagation();
            const target = document.getElementById(header.dataset.target);
            header.classList.toggle('active');
            target.classList.toggle('active');

            // Close others
            mobileHeaders.forEach(other => {
                if (other !== header) {
                    other.classList.remove('active');
                    document.getElementById(other.dataset.target).classList.remove('active');
                }
            });
        });
    });

    // ---------------- Generic Carousel ----------------
    function initCarousel(carouselId, cardSelector, indicatorClass=null, gap=20) {
        const carousel = document.getElementById(carouselId);
        if (!carousel) return;

        const cards = carousel.querySelectorAll(cardSelector);
        const indicators = indicatorClass ? document.querySelectorAll(`.${indicatorClass}`) : [];

        // Drag/Swipe
        let isDown = false, startX, scrollLeft;

        carousel.addEventListener('mousedown', e => {
            isDown = true;
            startX = e.pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
        });
        carousel.addEventListener('mouseup', () => isDown = false);
        carousel.addEventListener('mouseleave', () => isDown = false);
        carousel.addEventListener('mousemove', e => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - carousel.offsetLeft;
            const walk = (startX - x) * 2; // speed
            carousel.scrollLeft = scrollLeft + walk;
            updateIndicators();
        });

        // Touch for mobile
        carousel.addEventListener('touchstart', e => {
            startX = e.touches[0].pageX - carousel.offsetLeft;
            scrollLeft = carousel.scrollLeft;
        });
        carousel.addEventListener('touchmove', e => {
            const x = e.touches[0].pageX - carousel.offsetLeft;
            const walk = (startX - x) * 2;
            carousel.scrollLeft = scrollLeft + walk;
            updateIndicators();
        });

        function updateIndicators() {
            if (!indicators.length) return;
            const activeIndex = Math.round(carousel.scrollLeft / (cards[0].offsetWidth + gap));
            indicators.forEach((ind,i)=> ind.classList.toggle('active', i===activeIndex));
        }

        // Click indicator
        indicators.forEach((ind,i) => {
            ind.addEventListener('click', () => {
                carousel.scrollTo({
                    left: i * (cards[0].offsetWidth + gap),
                    behavior: 'smooth'
                });
            });
        });

        // Initial indicator update
        updateIndicators();
    }

    // ---------------- Initialize All Carousels ----------------
    initCarousel('carousel', '.card', 'indicator', 20);
    initCarousel('coursesSectionCarousel', '.courses-section-item', 'courses-section-indicator', 15);
    initCarousel('o-level-online-carousel', '.o-level-online-card', 'o-level-online-dot', 0);
    initCarousel('course2Carousel', '.course-2-section', 'course-2-indicator', 20);
    initCarousel('scrollArea', '.card', null, 20); // optional scroll area
});
