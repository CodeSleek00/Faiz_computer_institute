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

    let currentCourse = "";
let currentPrice = 0;

function showCourseDetails(name, description, price, type) {
  currentCourse = name;
  currentPrice = price;
  
  document.getElementById('modalCourseTitle').textContent = name;
  document.getElementById('modalCourseDescription').textContent = description;
  document.getElementById('modalCoursePrice').textContent = `₹${price}`;
  
  // Convert description into features list
  const featuresList = document.getElementById('modalFeaturesList');
  featuresList.innerHTML = '';
  
  // Split description by commas and create list items
  const features = description.split(',').map(item => item.trim());
  features.forEach(feature => {
    if (feature) {
      const li = document.createElement('li');
      li.className = 'modal-feature-item';
      li.textContent = feature;
      featuresList.appendChild(li);
    }
  });
  
  // Update enroll button
  const enrollBtn = document.getElementById('modalEnrollBtn');
  enrollBtn.onclick = function() {
    enrollNow(name, price);
  };
  
  // Show modal
  document.getElementById('courseDetailsModal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('courseDetailsModal').style.display = 'none';
}

// Close modal when clicking outside the content
document.getElementById('courseDetailsModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeModal();
  }
});

// Razorpay integration
function enrollNow(courseName, amount) {
  var options = {
    "key": "rzp_live_pA6jgjncp78sq7",
    "amount": amount * 100,
    "currency": "INR",
    "name": "Pyaara Store",
    "description": courseName,
    "handler": function (response) {
      alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
      window.location.href = 'thank_you.php';
    },
    "theme": {"color": "#1e40af"}
  };
  
  var rzp1 = new Razorpay(options);
  rzp1.open();
}
