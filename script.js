     const mobileToggle = document.getElementById('mobileToggle');
const mobileMenu = document.getElementById('mobileMenu');
const mobileClose = document.getElementById('mobileClose');
const overlay = document.getElementById('overlay');

// ✅ Toggle function (open/close)
function toggleMobileMenu() {
    const isActive = mobileMenu.classList.contains('active');
    if (isActive) {
        closeMobileMenu();
    } else {
        openMobileMenu();
    }
}

// ✅ Open menu
function openMobileMenu() {
    mobileMenu.classList.add('active');
    overlay.classList.add('active');
    document.body.style.overflow = 'hidden';
}

// ✅ Close menu
function closeMobileMenu() {
    mobileMenu.classList.remove('active');
    overlay.classList.remove('active');
    document.body.style.overflow = 'auto';

    // Close all dropdowns
    document.querySelectorAll('.mobile-dropdown').forEach(dropdown => dropdown.classList.remove('active'));
    document.querySelectorAll('.mobile-menu-header-item').forEach(header => header.classList.remove('active'));
}

// ✅ Click events
mobileToggle.addEventListener('click', toggleMobileMenu);
mobileClose.addEventListener('click', closeMobileMenu);
overlay.addEventListener('click', closeMobileMenu);

// ✅ Close when clicking anywhere outside the menu (desktop-like UX)
document.addEventListener('click', (e) => {
    const clickedInsideMenu = e.target.closest('#mobileMenu');
    const clickedToggle = e.target.closest('#mobileToggle');
    if (!clickedInsideMenu && !clickedToggle && mobileMenu.classList.contains('active')) {
        closeMobileMenu();
    }
});

// ✅ Mobile dropdowns
const mobileHeaders = document.querySelectorAll('.mobile-menu-header-item');

mobileHeaders.forEach(header => {
    header.addEventListener('click', (e) => {
        e.stopPropagation();
        const targetId = header.getAttribute('data-target');
        const targetDropdown = document.getElementById(targetId);

        header.classList.toggle('active');
        targetDropdown.classList.toggle('active');

        // Close others
        mobileHeaders.forEach(other => {
            if (other !== header) {
                other.classList.remove('active');
                document.getElementById(other.getAttribute('data-target')).classList.remove('active');
            }
        });
    });
});
       
        
        // Carousel functionality
        const carousel = document.getElementById("carousel");
        const next = document.querySelector(".next");
        const prev = document.querySelector(".prev");
        const indicators = document.querySelectorAll('.indicator');
        
        // Calculate scroll amount based on card width
        const scrollAmount = () => {
          const card = document.querySelector('.card');
          const cardWidth = card.offsetWidth;
          return cardWidth + 20; // 20px is the gap
        };

        // Update indicators based on scroll position
        function updateIndicators() {
          const scrollPos = carousel.scrollLeft;
          const cardWidth = document.querySelector('.card').offsetWidth + 20;
          const activeIndex = Math.round(scrollPos / cardWidth);
          
          indicators.forEach((indicator, index) => {
            if (index === activeIndex) {
              indicator.classList.add('active');
            } else {
              indicator.classList.remove('active');
            }
          });
        }

        // Scroll to specific card
        function scrollToCard(index) {
          const cardWidth = document.querySelector('.card').offsetWidth + 20;
          carousel.scrollTo({
            left: index * cardWidth,
            behavior: 'smooth'
          });
        }

        next.addEventListener("click", () => {
          carousel.scrollBy({ left: scrollAmount(), behavior: "smooth" });
        });
        
        prev.addEventListener("click", () => {
          carousel.scrollBy({ left: -scrollAmount(), behavior: "smooth" });
        });
        
        // Update indicators on scroll
        carousel.addEventListener('scroll', updateIndicators);
        
        // Add click events to indicators
        indicators.forEach(indicator => {
          indicator.addEventListener('click', () => {
            const index = parseInt(indicator.getAttribute('data-index'));
            scrollToCard(index);
          });
        });
        document.addEventListener('DOMContentLoaded', function() {
      const logoStrip = document.getElementById('logoStrip');
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      
      // Navigation functionality
      prevBtn.addEventListener('click', () => {
        logoStrip.scrollBy({
          left: -300,
          behavior: 'smooth'
        });
      });
      
      nextBtn.addEventListener('click', () => {
        logoStrip.scrollBy({
          left: 300,
          behavior: 'smooth'
        });
      });
      
      // Hide/show navigation buttons based on scroll position
      function updateNavButtons() {
        const scrollLeft = logoStrip.scrollLeft;
        const scrollWidth = logoStrip.scrollWidth;
        const clientWidth = logoStrip.clientWidth;
        
        prevBtn.style.display = scrollLeft > 10 ? 'flex' : 'none';
        nextBtn.style.display = scrollLeft < (scrollWidth - clientWidth - 10) ? 'flex' : 'none';
      }
      
      logoStrip.addEventListener('scroll', updateNavButtons);
      window.addEventListener('resize', updateNavButtons);
      updateNavButtons(); // Initial check
    });
    // Carousel functionality
const coursesSectionCarousel = document.getElementById('coursesSectionCarousel');
const coursesSectionIndicators = document.querySelectorAll('.courses-section-indicator');

// Update indicators on scroll
coursesSectionCarousel.addEventListener('scroll', () => {
    const scrollLeft = coursesSectionCarousel.scrollLeft;
    const sectionWidth = coursesSectionCarousel.querySelector('.courses-section-item').offsetWidth;
    const gap = 15;
    const activeIndex = Math.round(scrollLeft / (sectionWidth + gap));
    
    coursesSectionIndicators.forEach((indicator, index) => {
        if (index === activeIndex) {
            indicator.classList.add('active');
        } else {
            indicator.classList.remove('active');
        }
    });
});

// Click on indicators to scroll to specific section
coursesSectionIndicators.forEach(indicator => {
    indicator.addEventListener('click', () => {
        const index = parseInt(indicator.getAttribute('data-index'));
        const sectionWidth = coursesSectionCarousel.querySelector('.courses-section-item').offsetWidth;
        const gap = 15;
        coursesSectionCarousel.scrollTo({
            left: index * (sectionWidth + gap),
            behavior: 'smooth'
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const oLevelOnlineCarousel = document.getElementById('o-level-online-carousel');
    const oLevelOnlineDotsContainer = document.getElementById('o-level-online-dots');
    const oLevelOnlineCards = document.querySelectorAll('.o-level-online-card');
    
    let currentIndex = 0;
    let cardsPerView = 1;  // Each card is 100% width, so 1 per view

    function createOLevelOnlineDots() {
        oLevelOnlineDotsContainer.innerHTML = '';
        const totalDots = oLevelOnlineCards.length; // 1 dot per card
        for (let i = 0; i < totalDots; i++) {
            const dot = document.createElement('div');
            dot.classList.add('o-level-online-dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                goToOLevelOnlineSlide(i);
            });
            oLevelOnlineDotsContainer.appendChild(dot);
        }
    }

    function updateOLevelOnlineDots() {
        const dots = document.querySelectorAll('.o-level-online-dot');
        const activeDotIndex = Math.round(oLevelOnlineCarousel.scrollLeft / oLevelOnlineCards[0].offsetWidth);
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === activeDotIndex);
        });
    }

    function goToOLevelOnlineSlide(index) {
        oLevelOnlineCarousel.scrollTo({
            left: index * oLevelOnlineCards[0].offsetWidth,
            behavior: 'smooth'
        });
    }

    // Swipe/drag functionality
    let isDown = false;
    let startX;
    let scrollLeft;

    oLevelOnlineCarousel.addEventListener('mousedown', (e) => {
        isDown = true;
        oLevelOnlineCarousel.classList.add('active');
        startX = e.pageX - oLevelOnlineCarousel.offsetLeft;
        scrollLeft = oLevelOnlineCarousel.scrollLeft;
    });
    oLevelOnlineCarousel.addEventListener('mouseleave', () => isDown = false);
    oLevelOnlineCarousel.addEventListener('mouseup', () => isDown = false);
    oLevelOnlineCarousel.addEventListener('mousemove', (e) => {
        if(!isDown) return;
        e.preventDefault();
        const x = e.pageX - oLevelOnlineCarousel.offsetLeft;
        const walk = (startX - x) * 2; // scroll-fast
        oLevelOnlineCarousel.scrollLeft = scrollLeft + walk;
        updateOLevelOnlineDots();
    });

    // Touch for mobile
    oLevelOnlineCarousel.addEventListener('touchmove', () => updateOLevelOnlineDots());

    createOLevelOnlineDots();
    updateOLevelOnlineDots();
});
// Carousel functionality
const carousel2 = document.getElementById('course2Carousel');
const indicators2 = document.querySelectorAll('.course-2-indicator');

carousel2.addEventListener('scroll', () => {
    const scrollLeft = carousel2.scrollLeft;
    const sectionWidth = carousel2.querySelector('.course-2-section').offsetWidth;
    const gap = 20; // match CSS gap
    const activeIndex = Math.round(scrollLeft / (sectionWidth + gap));
    indicators2.forEach((ind,i) => i===activeIndex ? ind.classList.add('active') : ind.classList.remove('active'));
});

// Click indicator to scroll
indicators2.forEach(ind => {
    ind.addEventListener('click', () => {
        const index = parseInt(ind.getAttribute('data-index'));
        const sectionWidth = carousel2.querySelector('.course-2-section').offsetWidth;
        const gap = 20;
        carousel2.scrollTo({ left: index*(sectionWidth+gap), behavior:'smooth' });
    });
}); 
 // Optional: smooth scroll with mouse drag on desktop
    const scrollArea = document.getElementById('scrollArea');
    let isDown = false;
    let startX;
    let scrollLeft;

    scrollArea.addEventListener('mousedown', e => {
        isDown = true;
        scrollArea.classList.add('active');
        startX = e.pageX - scrollArea.offsetLeft;
        scrollLeft = scrollArea.scrollLeft;
    });

    scrollArea.addEventListener('mouseleave', () => {
        isDown = false;
        scrollArea.classList.remove('active');
    });

    scrollArea.addEventListener('mouseup', () => {
        isDown = false;
        scrollArea.classList.remove('active');
    });

    scrollArea.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - scrollArea.offsetLeft;
        const walk = (x - startX) * 2; // scroll speed
        scrollArea.scrollLeft = scrollLeft - walk;
    });