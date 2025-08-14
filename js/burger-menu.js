// Burger Menu Functionality
document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.querySelector('.burger-menu');
    const navMenu = document.querySelector('.nav-menu');
    
    if (burgerMenu && navMenu) {
        // Toggle menu when burger button is clicked
        burgerMenu.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            burgerMenu.classList.toggle('active');
            
            // Update aria-expanded attribute
            const isExpanded = navMenu.classList.contains('active');
            burgerMenu.setAttribute('aria-expanded', isExpanded);
        });
        
        // Close menu when clicking on a link
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                burgerMenu.classList.remove('active');
                burgerMenu.setAttribute('aria-expanded', 'false');
            });
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!burgerMenu.contains(e.target) && !navMenu.contains(e.target)) {
                navMenu.classList.remove('active');
                burgerMenu.classList.remove('active');
                burgerMenu.setAttribute('aria-expanded', 'false');
            }
        });
        
        // Close menu with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                burgerMenu.classList.remove('active');
                burgerMenu.setAttribute('aria-expanded', 'false');
            }
        });
    }
}); 