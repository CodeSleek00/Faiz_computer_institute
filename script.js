
document.addEventListener('DOMContentLoaded', function() {

    // ===== MOBILE MENU =====
    const mobileToggle = document.getElementById('mobileToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileClose = document.getElementById('mobileClose');
    const overlay = document.getElementById('overlay');

    function toggleMobileMenu() {
        const isActive = mobileMenu.classList.contains('active');
        if (isActive) closeMobileMenu(); else openMobileMenu();
    }

    function openMobileMenu() {
        mobileMenu.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = 'auto';
        document.querySelectorAll('.mobile-dropdown').forEach(d => d.classList.remove('active'));
        document.querySelectorAll('.mobile-menu-header-item').forEach(h => h.classList.remove('active'));
    }

    mobileToggle.addEventListener('click', toggleMobileMenu);
    mobileClose.addEventListener('click', closeMobileMenu);
    overlay.addEventListener('click', closeMobileMenu);

    document.addEventListener('click', (e) => {
        const clickedInsideMenu = e.target.closest('#mobileMenu');
        const clickedToggle = e.target.closest('#mobileToggle');
        if (!clickedInsideMenu && !clickedToggle && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });

    document.querySelectorAll('.mobile-menu-header-item').forEach(header => {
        header.addEventListener('click', (e) => {
            e.stopPropagation();
            const targetId = header.getAttribute('data-target');
            const targetDropdown = document.getElementById(targetId);
            header.classList.toggle('active');
            targetDropdown.classList.toggle('active');
            document.querySelectorAll('.mobile-menu-header-item').forEach(other => {
                if (other !== header) {
                    other.classList.remove('active');
                    document.getElementById(other.getAttribute('data-target')).classList.remove('active');
                }
            });
        });
    });

    // ===== CAROUSEL 1 =====
    const carousel = document.getElementById("carousel");
    const next = document.querySelector(".next");
    const prev = document.querySelector(".prev");
    const indicators = document.querySelectorAll('.indicator');

    const scrollAmount = () => {
        const card = document.querySelector('.card');
        return card.offsetWidth + 20;
    };

    function updateIndicators() {
        const scrollPos = carousel.scrollLeft;
        const cardWidth = document.querySelector('.card').offsetWidth + 20;
        const activeIndex = Math.round(scrollPos / cardWidth);
        indicators.forEach((ind, i) => ind.classList.toggle('active', i === activeIndex));
    }

    function scrollToCard(index) {
        const cardWidth = document.querySelector('.card').offsetWidth + 20;
        carousel.scrollTo({ left: index * cardWidth, behavior: 'smooth' });
    }

    next.addEventListener("click", () => carousel.scrollBy({ left: scrollAmount(), behavior: "smooth" }));
    prev.addEventListener("click", () => carousel.scrollBy({ left: -scrollAmount(), behavior: "smooth" }));
    carousel.addEventListener('scroll', updateIndicators);
    indicators.forEach(ind => ind.addEventListener('click', () => scrollToCard(parseInt(ind.dataset.index))));

    // ===== LOGO STRIP =====
    const logoStrip = document.getElementById('logoStrip');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    prevBtn.addEventListener('click', () => logoStrip.scrollBy({ left: -300, behavior: 'smooth' }));
    nextBtn.addEventListener('click', () => logoStrip.scrollBy({ left: 300, behavior: 'smooth' }));

    function updateNavButtons() {
        const scrollLeft = logoStrip.scrollLeft;
        const scrollWidth = logoStrip.scrollWidth;
        const clientWidth = logoStrip.clientWidth;
        prevBtn.style.display = scrollLeft > 10 ? 'flex' : 'none';
        nextBtn.style.display = scrollLeft < (scrollWidth - clientWidth - 10) ? 'flex' : 'none';
    }

    logoStrip.addEventListener('scroll', updateNavButtons);
    window.addEventListener('resize', updateNavButtons);
    updateNavButtons();

    // ===== O LEVEL CAROUSEL =====
    const oLevelOnlineCarousel = document.getElementById('o-level-online-carousel');
    const oLevelOnlineDotsContainer = document.getElementById('o-level-online-dots');
    const oLevelOnlineCards = document.querySelectorAll('.o-level-online-card');

    function createOLevelOnlineDots() {
        oLevelOnlineDotsContainer.innerHTML = '';
        oLevelOnlineCards.forEach((_, i) => {
            const dot = document.createElement('div');
            dot.classList.add('o-level-online-dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToOLevelOnlineSlide(i));
            oLevelOnlineDotsContainer.appendChild(dot);
        });
    }

    function updateOLevelOnlineDots() {
        const dots = document.querySelectorAll('.o-level-online-dot');
        const index = Math.round(oLevelOnlineCarousel.scrollLeft / oLevelOnlineCards[0].offsetWidth);
        dots.forEach((dot, i) => dot.classList.toggle('active', i === index));
    }

    function goToOLevelOnlineSlide(index) {
        oLevelOnlineCarousel.scrollTo({
            left: index * oLevelOnlineCards[0].offsetWidth,
            behavior: 'smooth'
        });
    }

    createOLevelOnlineDots();
    oLevelOnlineCarousel.addEventListener('scroll', updateOLevelOnlineDots);

    // ===== COURSE 2 CAROUSEL =====
    const carousel2 = document.getElementById('course2Carousel');
    const indicators2 = document.querySelectorAll('.course-2-indicator');

    carousel2.addEventListener('scroll', () => {
        const scrollLeft = carousel2.scrollLeft;
        const sectionWidth = carousel2.querySelector('.course-2-section').offsetWidth;
        const activeIndex = Math.round(scrollLeft / (sectionWidth + 20));
        indicators2.forEach((ind, i) => ind.classList.toggle('active', i === activeIndex));
    });

    indicators2.forEach(ind => {
        ind.addEventListener('click', () => {
            const index = parseInt(ind.dataset.index);
            const sectionWidth = carousel2.querySelector('.course-2-section').offsetWidth;
            carousel2.scrollTo({ left: index * (sectionWidth + 20), behavior: 'smooth' });
        });
    });

    // ===== DRAG SCROLL =====
    const scrollArea = document.getElementById('scrollArea');
    let isDown = false, startX, scrollLeft;

    scrollArea.addEventListener('mousedown', e => {
        isDown = true;
        scrollArea.classList.add('active');
        startX = e.pageX - scrollArea.offsetLeft;
        scrollLeft = scrollArea.scrollLeft;
    });
    scrollArea.addEventListener('mouseleave', () => isDown = false);
    scrollArea.addEventListener('mouseup', () => isDown = false);
    scrollArea.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollArea.offsetLeft;
        const walk = (x - startX) * 2;
        scrollArea.scrollLeft = scrollLeft - walk;
    });

});
