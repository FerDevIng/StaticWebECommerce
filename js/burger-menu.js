// Burger Menu Functionality for Mobile Navigation
// This script handles the responsive mobile navigation menu
// Provides accessibility features and keyboard navigation support

// Wait for the DOM to be fully loaded before running the script
// This ensures all HTML elements are available for JavaScript manipulation
document.addEventListener('DOMContentLoaded', function() {
    // Get references to the burger menu button and navigation menu
    // These elements are used for toggling the mobile menu
    const burgerMenu = document.querySelector('.burger-menu');
    const navMenu = document.querySelector('.nav-menu');
    
    // Only proceed if both elements exist (prevents errors on pages without navigation)
    if (burgerMenu && navMenu) {
        // Toggle menu visibility when burger button is clicked
        // This is the main interaction for opening/closing the mobile menu
        burgerMenu.addEventListener('click', function() {
            // Toggle the 'active' class on both elements
            // CSS uses this class to show/hide the menu and animate the burger icon
            navMenu.classList.toggle('active');
            burgerMenu.classList.toggle('active');
            
            // Update accessibility attribute for screen readers
            // aria-expanded tells assistive technology whether the menu is open or closed
            const isExpanded = navMenu.classList.contains('active');
            burgerMenu.setAttribute('aria-expanded', isExpanded);
        });
        
        // Close menu when user clicks on a navigation link
        // This provides a better UX by automatically closing the menu after selection
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active classes to close the menu
                navMenu.classList.remove('active');
                burgerMenu.classList.remove('active');
                // Update accessibility attribute
                burgerMenu.setAttribute('aria-expanded', 'false');
            });
        });
        
        // Close menu when clicking outside of it
        // This is a common UX pattern that allows users to dismiss the menu easily
        document.addEventListener('click', function(e) {
            // Check if the click was outside both the burger button and navigation menu
            if (!burgerMenu.contains(e.target) && !navMenu.contains(e.target)) {
                // Close the menu by removing active classes
                navMenu.classList.remove('active');
                burgerMenu.classList.remove('active');
                // Update accessibility attribute
                burgerMenu.setAttribute('aria-expanded', 'false');
            }
        });
        
        // Close menu with Escape key for keyboard accessibility
        // This provides an alternative way to close the menu for keyboard users
        document.addEventListener('keydown', function(e) {
            // Check if Escape key was pressed and menu is currently open
            if (e.key === 'Escape' && navMenu.classList.contains('active')) {
                // Close the menu
                navMenu.classList.remove('active');
                burgerMenu.classList.remove('active');
                // Update accessibility attribute
                burgerMenu.setAttribute('aria-expanded', 'false');
            }
        });
    }
}); 