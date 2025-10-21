
document.addEventListener('DOMContentLoaded', () => {

  // =========================
  // 1️⃣ Mobile Menu Logic
  // =========================
  const mobileToggle = document.getElementById('mobileToggle');
  const mobileMenu = document.getElementById('mobileMenu');
  const mobileClose = document.getElementById('mobileClose');
  const overlay = document.getElementById('overlay');
  const mobileHeaders = document.querySelectorAll('.mobile-menu-header-item');

  function openMobileMenu() {
      mobileMenu.classList.add('active');
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
  }

  function closeMobileMenu() {
      mobileMenu.classList.remove('active');
      overlay.classList.remove('active');
      document.body.style.overflow = 'auto';

      // Close all dropdowns
      mobileHeaders.forEach(header => header.classList.remove('active'));
      document.querySelectorAll('.mobile-dropdown').forEach(dropdown => dropdown.classList.remove('active'));
  }

  // Toggle menu
  mobileToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      mobileMenu.classList.contains('active') ? closeMobileMenu() : openMobileMenu();
  });

  // Close via close button or overlay
  mobileClose.addEventListener('click', closeMobileMenu);
  overlay.addEventListener('click', closeMobileMenu);

  // Dropdown toggles
  mobileHeaders.forEach(header => {
      header.addEventListener('click', (e) => {
          e.stopPropagation();
          const targetId = header.dataset.target;
          const targetDropdown = document.getElementById(targetId);

          // Toggle current
          header.classList.toggle('active');
          targetDropdown.classList.toggle('active');

          // Close others
          mobileHeaders.forEach(other => {
              if (other !== header) {
                  other.classList.remove('active');
                  const otherDropdown = document.getElementById(other.dataset.target);
                  otherDropdown.classList.remove('active');
              }
          });
      });
  });

  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
      const clickedInsideMenu = e.target.closest('#mobileMenu');
      const clickedToggle = e.target.closest('#mobileToggle');
      if (!clickedInsideMenu && !clickedToggle && mobileMenu.classList.contains('active')) {
          closeMobileMenu();
      }
  });

  // =========================
  // 2️⃣ Generic Carousel Function
  // =========================
  function initCarousel(carouselId, prevBtnId, nextBtnId, indicatorClass, cardSelector, gap=20) {
      const carousel = document.getElementById(carouselId);
      if (!carousel) return;

      const prevBtn = prevBtnId ? document.getElementById(prevBtnId) : null;
      const nextBtn = nextBtnId ? document.getElementById(nextBtnId) : null;
      const indicators = indicatorClass ? document.querySelectorAll(`.${indicatorClass}`) : [];
      const cards = carousel.querySelectorAll(cardSelector);

      // Scroll by one card
      const scrollAmount = () => cards[0] ? cards[0].offsetWidth + gap : 0;

      // Update indicators
      const updateIndicators = () => {
          const scrollLeft = carousel.scrollLeft;
          const activeIndex = cards[0] ? Math.round(scrollLeft / (cards[0].offsetWidth + gap)) : 0;
          indicators.forEach((ind,i) => i===activeIndex ? ind.classList.add('active') : ind.classList.remove('active'));
      }

      // Click indicator
      indicators.forEach(ind => {
          ind.addEventListener('click', () => {
              const index = parseInt(ind.dataset.index);
              if (!cards[0]) return;
              carousel.scrollTo({ left: index * (cards[0].offsetWidth + gap), behavior: 'smooth' });
          });
      });

      // Prev/Next buttons
      if(prevBtn) prevBtn.addEventListener('click', () => carousel.scrollBy({ left: -scrollAmount(), behavior: 'smooth' }));
      if(nextBtn) nextBtn.addEventListener('click', () => carousel.scrollBy({ left: scrollAmount(), behavior: 'smooth' }));

      // Drag/Swipe functionality
      let isDown = false, startX, scrollStart;
      carousel.addEventListener('mousedown', (e) => { isDown=true; startX=e.pageX - carousel.offsetLeft; scrollStart=carousel.scrollLeft; carousel.classList.add('active'); });
      carousel.addEventListener('mouseleave', () => isDown=false);
      carousel.addEventListener('mouseup', () => isDown=false);
      carousel.addEventListener('mousemove', (e) => {
          if(!isDown) return;
          e.preventDefault();
          const x = e.pageX - carousel.offsetLeft;
          const walk = (startX - x) * 2;
          carousel.scrollLeft = scrollStart + walk;
          updateIndicators();
      });

      // Touch for mobile
      carousel.addEventListener('touchmove', updateIndicators);
      carousel.addEventListener('scroll', updateIndicators);

      // Initial indicators
      updateIndicators();
  }

  // Example usage: initialize your carousels
  initCarousel('carousel', 'prevBtn', 'nextBtn', 'indicator', '.card', 20);
  initCarousel('coursesSectionCarousel', null, null, 'courses-section-indicator', '.courses-section-item', 15);
  initCarousel('o-level-online-carousel', null, null, 'o-level-online-dot', '.o-level-online-card', 0);
  initCarousel('course2Carousel', null, null, 'course-2-indicator', '.course-2-section', 20);

});