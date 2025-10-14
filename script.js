      // Mobile menu toggle
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
            
            // Close all dropdowns when closing menu
            document.querySelectorAll('.mobile-dropdown').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            document.querySelectorAll('.mobile-menu-header-item').forEach(header => {
                header.classList.remove('active');
            });
        }
        
        mobileToggle.addEventListener('click', openMobileMenu);
        mobileClose.addEventListener('click', closeMobileMenu);
        overlay.addEventListener('click', closeMobileMenu);

        // Mobile dropdown functionality
        const mobileHeaders = document.querySelectorAll('.mobile-menu-header-item');
        
        mobileHeaders.forEach(header => {
            header.addEventListener('click', (e) => {
                e.stopPropagation();
                const targetId = header.getAttribute('data-target');
                const targetDropdown = document.getElementById(targetId);
                
                // Toggle current dropdown
                header.classList.toggle('active');
                targetDropdown.classList.toggle('active');
                
                // Close other dropdowns
                mobileHeaders.forEach(otherHeader => {
                    if (otherHeader !== header) {
                        otherHeader.classList.remove('active');
                        const otherTargetId = otherHeader.getAttribute('data-target');
                        const otherTargetDropdown = document.getElementById(otherTargetId);
                        otherTargetDropdown.classList.remove('active');
                    }
                });
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.mobile-menu-header-item')) {
                mobileHeaders.forEach(header => {
                    header.classList.remove('active');
                    const targetId = header.getAttribute('data-target');
                    const targetDropdown = document.getElementById(targetId);
                    targetDropdown.classList.remove('active');
                });
            }
        });

        // Prevent clicks inside mobile menu from closing it
        mobileMenu.addEventListener('click', (e) => {
            e.stopPropagation();
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