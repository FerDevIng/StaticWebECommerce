// Main JavaScript Functionality
// This script handles the primary user interactions on the website
// Currently manages the call-to-action button on the homepage

// Wait for the DOM to be fully loaded before running the script
// This ensures all HTML elements are available for JavaScript manipulation
document.addEventListener("DOMContentLoaded", function () {
    // Get reference to the call-to-action button
    // This button is typically used to direct users to the shop or main action
    const ctaButton = document.getElementById("cta-button");
    
    // Only proceed if the button exists (prevents errors on pages without this element)
    if (ctaButton) {
        // Add click event listener to the CTA button
        // This handles user interaction when they click the button
        ctaButton.addEventListener("click", function () {
            // Show a temporary alert message to inform the user
            // In a production environment, this might be replaced with a smoother transition
            alert("Redirecting to shop page...");
            
            // Redirect the user to the shop page
            // This changes the current page to shop.html
            window.location.href = "shop.html";
        });
    }
});

 