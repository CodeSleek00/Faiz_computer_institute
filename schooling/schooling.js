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
 // Smooth preloader fade-out
    window.addEventListener("load", () => {
      const preloader = document.getElementById("preloader");
      setTimeout(() => {
        preloader.classList.add("fade-out");
        setTimeout(() => preloader.style.display = "none", 800);
      }, 1000);
    });
     // Counter animation function
    function runCounters() {
      const counters = document.querySelectorAll('.stat h2');
      counters.forEach(counter => {
        counter.innerText = '0'; // Reset to 0 before starting
        const target = +counter.getAttribute('data-target');
        const suffix = counter.textContent.replace(/[0-9]/g, '').trim(); // Keep suffix like %, +, m
        const speed = 50;

        let count = 0;
        const updateCount = () => {
          const increment = target / speed;
          if (count < target) {
            count += increment;
            counter.innerText = Math.ceil(count) + suffix;
            setTimeout(updateCount, 30);
          } else {
            counter.innerText = target + suffix;
          }
        };
        updateCount();
      });
    }

    // Run when page loads
    runCounters();

    // Run again whenever user switches back to the tab
    document.addEventListener("visibilitychange", function() {
      if (document.visibilityState === "visible") {
        runCounters();
      }
    });
      // Accordion logic - all items start closed
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', () => {
        const item = header.parentElement;
        const isActive = item.classList.contains('active');
        
        // Close all accordion items
        document.querySelectorAll('.accordion-item').forEach(i => {
          i.classList.remove('active');
        });
        
        // If the clicked item wasn't active, open it
        if (!isActive) {
          item.classList.add('active');
        }
      });
    });