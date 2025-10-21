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
      }, 1500);
    });